<?php

declare(strict_types=1);

require_once 'vendor/autoload.php';

use League\CLImate\CLImate;
use Respect\Validation\Validator as v;

$climate = new CLImate();

$numeroPositivo = function ($valor) use ($climate) {
    $valido = v::number()->positive()->validate($valor);
    if (!$valido) {
        $climate->red()->out('Valor deve ser um número positivo!');
    }

    return $valido;
};

$climate = new CLImate();

$padding = $climate->padding(20);

$padding->label('Somar valores')->result('[1]');
$padding->label('Subtrair valores')->result('[2]');
$padding->label('Mutiplicar valores')->result('[3]');
$padding->label('Sair')->result('[q]');

$climate->br();

$input = $climate->input('Selecione uma opção do MENU:');
$input->accept([1, 2, 3, 'q']);
$input->strict();

$response = $input->prompt();

switch ($response) {
    case '1';
        $primeiroNumero = $climate->input('Primeiro valor:');
        $primeiroNumero->accept($numeroPositivo);
        $valorPrimeiroNumero = $primeiroNumero->prompt();
        $segundoNumero = $climate->input('Segundo valor:');
        $segundoNumero->accept($numeroPositivo);
        $valorSegundoNumero = $segundoNumero->prompt();
        $soma = $valorPrimeiroNumero + $valorSegundoNumero;
        $climate->output(sprintf('Soma %s com %s é igual: %s', $valorPrimeiroNumero, $valorSegundoNumero, $soma));
        break;
        
    case '2';
        $primeiroNumero = $climate->input('Primeiro valor:');
        $primeiroNumero->accept($numeroPositivo);
        $valorPrimeiroNumero = $primeiroNumero->prompt();
        $segundoNumero = $climate->input('Segundo valor:');
        $primeiroNumero->accept($numeroPositivo);
        $valorSegundoNumero = $segundoNumero->prompt();
        $subtrair = $valorPrimeiroNumero - $valorSegundoNumero;
        $climate->output(sprintf('Subtração %s com %s é igual: %s', $valorPrimeiroNumero, $valorSegundoNumero, $subtrair));
        break;

    case '3';
        $primeiroNumero = $climate->input('Primeiro valor:');
        $primeiroNumero->accept($numeroPositivo);
        $valorPrimeiroNumero = $primeiroNumero->prompt();
        $segundoNumero = $climate->input('Segundo valor:');
        $primeiroNumero->accept($numeroPositivo);
        $valorSegundoNumero = $segundoNumero->prompt();
        $multiplica = $valorPrimeiroNumero * $valorSegundoNumero;
        $climate->output(sprintf('Multiplicação %s com %s é igual: %s', $valorPrimeiroNumero, $valorSegundoNumero, $multiplica));
        break;
    
    default:
        $climate->out('Sistema encerrado.');
        break;
}