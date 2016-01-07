<?php namespace Money;
use Money\Exceptions\InvalidAmountException;

/**
 * Description of Money
 *
 * @author Bright Antwi Boasiako<brightantwiboasiako@aol.com>
 */
class Money 
{
    
    /**
     * private int $amount
     * 
     * The whole part of the money
     * 
     * @var int
     * 
     * @access private
     */
    private $whole = 0;


    /**
     * private int fraction
     *
     * The fractional part of the money
     *
     * @var int
     *
     * @access private
     */
    private $fraction = 0;
    
    
    /**
     * private Money\Currency $currency
     * 
     * The currency of the money
     * 
     * @var Currency
     * 
     * @access private
     */
    private $currency;
    
    
    /**
     * public Money\Money(\Money\Currency $currency)
     * 
     * Instantiates the currency object
     * 
     * @param \Money\Currency $currency
     */
    public function __construct($amount, Currency $currency = null)
    {
        $this->setAmount($amount);
        $this->setCurrency($currency);
    }
    
    
    /**
     * private void setAmount(double $amount)
     * 
     * Sets the amount of the money
     * 
     * @param double $amount
     * 
     * @return void
     */
    private function setAmount($amount)
    {
        $this->setWhole($amount);
        $this->setFraction($amount);
    }


    /**
     * Sets the whole number part of the money
     *
     * @param $amount
     * @return void
     */
    private function setWhole($amount)
    {
        $this->whole = (int)floor($amount);
    }


    /**
     * Sets the fractional part of the money
     *
     * @param $amount
     * @return void
     */
    private function setFraction($amount)
    {

        $doubleFraction = $amount * 100;

        $intFraction = ($this->round(abs($doubleFraction))) % 100;

        if($intFraction < 0)
            $intFraction = -$intFraction;

        $this->fraction = $intFraction;

    }


    private function round($number)
    {
        return (int)floor($number + 0.5);
    }


    public function add(Money $money)
    {
        $sum = $this->getAmount() + $money->getAmount();

        $this->setWhole($sum);
        $this->setFraction($sum);

        return $this;
    }


    /**
     * @param Money $money
     */
    public function subtract(Money $money)
    {
        $diff = new Money($this->getAmount() - $money->getAmount());

        $this->setWhole($diff->getAmount());
        $this->setFraction($diff->getAmount());

        return $this;
    }


    public function times($factor)
    {
        $totalFactor = $factor * $this->getAmount();

        $this->setWhole($totalFactor);
        $this->setFraction($totalFactor);

        return $this;
    }


    /**
     * @param Money $money
     * @return bool
     */
    public function lessThan(Money $money)
    {
        return $this->getAmount() < $money->getAmount();
    }

    /**
     * @param Money $money
     * @return bool
     */
    public function greaterThan(Money $money)
    {
        return $this->getAmount() > $money->getAmount();
    }


    /**
     * @param Money $money
     * @return bool
     */
    public function notLessThan(Money $money)
    {
        return $this->getAmount() >= $money->getAmount();
    }


    /**
     * @param Money $money
     * @return bool
     */
    public function notGreaterThan(Money $money)
    {
        return $this->getAmount() <= $money->getAmount();
    }


    public function equals(Money $money)
    {
        return $this->getWhole() == $money->getWhole()
               && $this->getFraction() == $money->getFraction();
    }

    
    /**
     * public double getAmount(void)
     * 
     * Gets the amount of the money
     * 
     * 
     * @return double
     */
    public function getAmount()
    {
        return (double)($this->getWhole() + 0.01 * $this->getFraction());
    }
    
    
    /**
     * public int getWhole(void)
     * 
     * Gets the whole number part of the money
     * 
     * @return int
     */
    public function getWhole()
    {
        return $this->whole;
    }
    
    
    /**
     * public int getFraction(void)
     * 
     * Gets the fraction part of the money
     * 
     * @return int
     */
    public function getFraction()
    {
        return $this->fraction;
    }
    
    
    /**
     * private void setCurrency(\Money\Currency $currency)
     * 
     * Sets the currency of the money
     * 
     * @param \Money\Currency $currency
     * 
     * @return void
     */
    private function setCurrency(Currency $currency = null)
    {
        if($currency != null)
            $this->currency = $currency;
        else
        {
            $this->currency = new Currency();
        }
    }
    
    /**
     * private \Money\Currency getCurrency(void)
     * 
     * Gets the currency of the money
     * 
     * 
     * @return \Money\Currency
     */
    private function getCurrency()
    {
        return $this->currency;
    }
    
    
    /**
     * public String __toString(void)
     * 
     * Gets the string representation of the money
     * 
     * @return String
     */
    public function __toString()
    {
        return $this->getCurrency()->format($this->getAmount());
    }
    
}
