<?php
if (!@include __DIR__ . '/../../vendor/.composer/autoload.php') {
    die(<<<'EOT'
You must set up the project dependencies, run the following commands:
wget http://getcomposer.org/composer.phar
php composer.phar install
EOT
    );
}

use Behat\Behat\Context\ClosuredContextInterface,
    Behat\Behat\Context\TranslatedContextInterface,
    Behat\Behat\Context\BehatContext,
    Behat\Behat\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode,
    Behat\Gherkin\Node\TableNode;

use Vespolina\Entity\Order;
use Vespolina\Invoice\InvoiceManager;

//
// Require 3rd-party libraries here:

   require_once 'PHPUnit/Autoload.php';
   require_once 'PHPUnit/Framework/Assert/Functions.php';


/**
 * Features context.
 */
class FeatureContext extends BehatContext
{
    protected $invoice;
    protected $order;
    protected $manager;

    /**
     * Initializes context.
     * Every scenario gets it's own context object.
     *
     * @param   array   $parameters     context parameters (set them up through behat.yml)
     */
    public function __construct(array $parameters)
    {
        $this->manager = new InvoiceManager('\Vespolina\Entity\Invoice');
    }

    /**
     * @Given /^the customer has an order$/
     */
    public function theCustomerHasAnOrder()
    {
        $this->order = new Order();
    }
    /**
     * @When /^I create an invoice with the order$/
     */
    public function iCreateAnInvoiceWithTheOrder()
    {
        $this->invoice = $this->manager->createInvoice();
        $this->invoice->setOrder($this->order);
    }

    /**
     * @Then /^I should receive an invoice$/
     */
    public function iShouldReceiveAnInvoice()
    {
        assertInstanceOf('Vespolina\Entity\InvoiceInterface', $this->invoice);
    }

    /**
     * @Given /^the invoice should contain the "([^"]*)"$/
     */
    public function theInvoiceShouldContainThe($argument1)
    {
        $getter = 'get' . ucfirst(strtolower($argument1));
        assertSame($this->order, $this->invoice->$getter());
    }

    /**
     * @Given /^I have created an invoice due in "([^"]*)" days$/
     */
    public function iHaveCreatedAnInvoiceDueInDays($argument1)
    {
        throw new PendingException();
    }

    /**
     * @Given /^I have created an invoice due in "([^"]*)" days that has been paid$/
     */
    public function iHaveCreatedAnInvoiceDueInDaysThatHasBeenPaid($argument1)
    {
        throw new PendingException();
    }

    /**
     * @When /^I ask for invoices past due by at least "([^"]*)" days$/
     */
    public function iAskForInvoicesPastDueByAtLeastDays($argument1)
    {
        throw new PendingException();
    }

    /**
     * @Then /^I should receive the invoice due in "([^"]*)" days$/
     */
    public function iShouldReceiveTheInvoiceDueInDays($argument1)
    {
        throw new PendingException();
    }

    /**
     * @Given /^I should not receive the invoice due in "([^"]*)" days$/
     */
    public function iShouldNotReceiveTheInvoiceDueInDays($argument1)
    {
        throw new PendingException();
    }

    /**
     * @Given /^the invoice due in "([^"]*)" days has already been sent at the "([^"]*)" day mark$/
     */
    public function theInvoiceDueInDaysHasAlreadyBeenSentAtTheDayMark($argument1, $argument2)
    {
        throw new PendingException();
    }

    /**
     * @When /^I ask for invoices due in "([^"]*)" days$/
     */
    public function iAskForInvoicesDueInDays($argument1)
    {
        throw new PendingException();
    }

}
