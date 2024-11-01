<?php
    enum CoffeeType: string
    {
        case ESPRESSO = 'Espresso';
        case LATTE = 'Latte';
        case AMERICANO = 'Americano';
    }

    enum TeaType: string
    {
        case BLACK = 'Black';
        case GREEN = 'Green';
    }

    trait Discountable {
        public function applyDiscount($amount)
        {
            $this->price -= $amount;
            if ($this->price < 0) {
                $this->price = 0; // Ensure price does not go below zero
            }
        }
    }


    abstract class Beverage
    {
        protected $name;
        protected $price;

        public function __construct($name, $price)
        {
            $this->name = $name;
            $this->price = $price;
        }

        abstract public function calculateTotalPrice($quantity);

    }


    class Coffee extends Beverage
    {
        use Discountable;
        private CoffeeType $type;

        public function __construct($name, $price, CoffeeType $type)
        {
            parent::__construct($name, $price);
            $this->type = $type;
        }
        public function calculateTotalPrice($quantity)
        {
            return $this->price * $quantity;
        }
        public function getType(): CoffeeType
        {
            return $this->type;
        }
    }

    class Tea extends Beverage {
        use Discountable;

        private TeaType $type;

        public function __construct($name, $price, TeaType $type) {
            parent::__construct($name, $price);
            $this->type = $type;
        }

        public function calculateTotalPrice($quantity) {
            return $this->price * $quantity;
        }

        public function getType(): TeaType {
            return $this->type;
        }
    }

    class Order
    {
        private array $items = [];

        public function addItem(Beverage $beverage, int $quantity): void
        {
            $this->items[] = [
                'beverage' => $beverage,
                'quantity' => $quantity
            ];
        }

        public function calculateOrderTotal(): float
        {
            $total = 0;
            foreach ($this->items as $item) {
                $beverage = $item['beverage'];
                $quantity = $item['quantity'];
                $total += $beverage->calculateTotalPrice($quantity);
            }
            return $total;
        }
    }

$coffee = new Coffee("Espresso", 140.0, CoffeeType::ESPRESSO);
$tea = new Tea("Green Tea", 100.0, TeaType::GREEN);
$coffee2 = new Coffee("Ladno Espresso", 140.0, CoffeeType::ESPRESSO);

$coffee->applyDiscount(20.0);  // Apply a discount
$order = new Order();
$order->addItem($coffee, 2);  // 2 espresso
$order->addItem($coffee2, 2);  // 2 espresso
$order->addItem($tea, 1);     // 1 green tea
echo "Total order amount: " . $order->calculateOrderTotal() . " MKD";
print_r($order);