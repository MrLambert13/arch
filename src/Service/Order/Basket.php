<?php

declare(strict_types=1);

namespace Service\Order;

use Framework\Registry;
use Model;
use Service\Billing\Card;
use Service\Billing\Exception\BillingException;
use Service\Communication\Email;
use Service\Communication\Exception\CommunicationException;
use Service\Discount\NullObject;
use Service\User\Security;
use SplObserver;
use SplSubject;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Service\Order\TransactionPattern;

class Basket implements SplSubject
{
    /**
     * Сессионный ключ списка всех продуктов корзины
     */
    private const BASKET_DATA_KEY = 'basket';

    /**
     * @var SessionInterface
     */
    private $session;

    /**
     * @var array
     */
    private $observers = [];

    /**
     * @param SessionInterface $session
     */
    public function __construct(SessionInterface $session)
    {
        $this->session = $session;

        foreach (Registry::getDataConfig('order.observers') as $observer) {
            $this->attach(new $observer());
        }
    }

    /**
     * Добавляем товар в заказ
     *
     * @param int $product
     *
     * @return void
     */
    public function addProduct(int $product): void
    {
        $basket = $this->session->get(static::BASKET_DATA_KEY, []);
        if (!in_array($product, $basket, true)) {
            $basket[] = $product;
            $this->session->set(static::BASKET_DATA_KEY, $basket);
        }
    }

    /**
     * Проверяем, лежит ли продукт в корзине или нет
     *
     * @param int $productId
     *
     * @return bool
     */
    public function isProductInBasket(int $productId): bool
    {
        return in_array($productId, $this->getProductIds(), true);
    }

    /**
     * Получаем информацию по всем продуктам в корзине
     * @return Model\Entity\Product[]
     */
    public function getProductsInfo(): array
    {
        $productIds = $this->getProductIds();
        return $this->getProductRepository()->search($productIds);
    }

    /**
     * Оформление заказа
     * @return void
     */
    public function checkout(): void
    {
        $checkout = new CheckoutBuilder();
        $checkout->setBilling(new Card());
        $checkout->setDiscount(new NullObject());
        $checkout->setCommunication(new Email());
        $checkout->setSecurity(new Security($this->session));

        $this->checkoutProcess($checkout->build());
    }

    /**
     * Проведение всех этапов заказа
     *
     * @param CheckoutBuilder
     *
     * @return void
     */
    public function checkoutProcess(
        CheckoutBuilder $checkoutBuilder
    ): void
    {
        $totalPrice = 0;
        foreach ($this->getProductsInfo() as $product) {
            $totalPrice += $product->getPrice();
        }

        $discount = $checkoutBuilder->getDiscount()->getDiscount();
        $totalPrice = $totalPrice - $totalPrice / 100 * $discount;

        try {
            $checkoutBuilder->getBilling()->pay($totalPrice);
        } catch (BillingException $e) {
        }

        $user = $checkoutBuilder->getSecurity()->getUser();
        try {
            $checkoutBuilder->getCommunication()->process($user, 'checkout_template');
        } catch (CommunicationException $e) {
        }
    }

    /**
     * Фабричный метод для репозитория Product
     * Классу basket неизвестно какие объекты подклассов ему нужно создавать. Вроде.
     * Хотя был бы интерфейс было бы лучше.
     * @return Model\Repository\Product
     */
    protected function getProductRepository(): Model\Repository\Product
    {
        return new Model\Repository\Product();
    }

    /**
     * Получаем список id товаров корзины
     * @return array
     */
    private function getProductIds(): array
    {
        return $this->session->get(static::BASKET_DATA_KEY, []);
    }

    /**
     * Attach an SplObserver
     * @link  https://php.net/manual/en/splsubject.attach.php
     *
     * @param SplObserver $observer
     *
     * @return void
     * @since 5.1.0
     */
    public function attach(SplObserver $observer)
    {
        if (!array_key_exists(get_class($observer), $this->observers)) {
            $this->observers[get_class($observer)] = $observer;
        }
    }

    /**
     * Detach an observer
     * @link  https://php.net/manual/en/splsubject.detach.php
     *
     * @param SplObserver $observer <p>
     *                              The <b>SplObserver</b> to detach.
     *                              </p>
     *
     * @return void
     * @since 5.1.0
     */
    public function detach(SplObserver $observer)
    {
        unset($this->observers[get_class($observer)]);
    }

    /**
     * Notify an observer
     * @link  https://php.net/manual/en/splsubject.notify.php
     * @return void
     * @since 5.1.0
     */
    public function notify()
    {
        foreach ($this->observers as $observer) {
            $observer->update(null);
        }
    }
}
