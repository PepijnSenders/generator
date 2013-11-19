<?php

use Pep\Generator\Commands\AssetCommand;
use Symfony\Component\Console\Tester\CommandTester;
use Mockery as m;

class AssetCommandTest extends PHPUnit_Framework_TestCase {

    public function tearDown()
    {
        m::close();
    }

    public function testGeneratesController()
    {
        $gen = m::mock('Pep\Generator\Generator\AssetGenerator');
        $gen->shouldReceive('make')
            ->once()
            ->with(app_path() . '/controllers/FooController.php', 'foo')
            ->andReturn(true);

        $command = new AssetCommand($gen);

        $tester = new CommandTester($command);
        $tester->execute(['name' => 'FooController', '--template' => 'foo']);

        $this->assertEquals("Created " . app . "/controllers/FooController.php\n", $tester->getDisplay());
    }

    public function testCanSetCustomPath()
    {
        $gen = m::mock('Pep\Generator\Generator\AssetGenerator[make]');
        $gen->shouldReceive('make')->once()->andReturn(true);

        $command = new AssetCommand($gen);

        $tester = new CommandTester($command);
        $tester->execute(['name' => 'FooController', '--path' => 'app', '--template' => 'foo']);

        $this->assertEquals("Created " . app . "/FooController.php\n", $tester->getDisplay());
    }

    public function testCanSetCustomStub()
    {
        $gen = m::mock('Pep\Generator\Generator\AssetGenerator[make]');
        $gen->shouldReceive('make')
            ->once()
            ->with(app_path() . '/controllers/FooController.php', 'foo')
            ->andReturn(true);

        $command = new AssetCommand($gen);

        $tester = new CommandTester($command);
        $tester->execute(['name' => 'FooController', '--template' => 'foo']);
    }

}