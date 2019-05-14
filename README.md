# Transformacje AngularJS
Transformacje AngularaJS do Angulara

## Wymagania
Do uruchomienia aplikacji potrzebne są następujące rzeczy:
```text
1. Git
2. PHP >= 7.1
3. Composer
```

## Uruchomienie
 Aby uruchomić aplikację należy pobrać ją z git'a. Nastepnie w głównym katalogu aplikacji wykonać polecenie

```bash
composer install
```
Spowoduje to zainstalowanie wszystkich potrzebnych zależności oraz poprawne skonfigurowanie aplikacji.

## Testy jednostkowe
W celu sprawdzenia poprawności instalacji, należy wykonać zbiór testów jednostkowych. <br>
Aby tego dokonać należy wykonać polecenie:
```bash
php bin/phpunit
```

## Działanie
Aby przeprowadzić transformację należy wykonać polecenie
```bash
php bin/console transformation:run -i input -o output
```
Gdzie zamiast `input` należy podać lokalizację pliku do transformacji, natomaist zamiast `output` należy podać folder
gdzię będą odkładane wyniki transformacji

### Działający przykład
w katalogu output, w głównym katalogu znajdzie się wynik transformacji
```bash
php bin/console transformation:run -i test.html -o output
```
