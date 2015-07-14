<?php namespace Money;

/**
 * Description of Money
 *
 * @author Bright Antwi Boasiako<brightantwiboasiako@aol.com>
 */
class Money 
{
    
    /**
     * private double $amount
     * 
     * Amount of the money
     * 
     * @var double
     * 
     * @access private
     */
    private $amount = 0.00;
    
    
    /**
     * private Money\Currency $currency
     * 
     * The currency of the money
     * 
     * @var Money\Currency
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
    public function __construct($amount, Currency $currency)
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
        $this->amount = $amount;
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
        return $this->amount;
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
        return floor($this->getAmount());
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
        return number_format($this->getAmount() - $this->getWhole(), 2) * 100;
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
    private function setCurrency(Currency $currency)
    {
        $this->currency = $currency;
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
