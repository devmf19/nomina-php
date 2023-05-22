# nomina-php

Proyecto que pone en practica le programacion orientada a objetos y herencia en php.

Consiste en crear un formulario que permitra registrar empleados con sus horas de trabajo y el respectivo precio de cada hora.

Se realizan calculos de la siguiente forma (el salario minimo ($min_pay) esta quemado directamente en la clase Person y tiene un valor de $250):

- salario basico ($basic_pay) debe ser el resultado de la multiplicacion del numero de horas trabajadas por su valor
- el subsidio ($subsidy) debe ser el 10% del valor de salario basico si este es menor a dos salarios minimos
- la retencion de fuente ($source_retention) se debe descontar y debe ser el 7% del valor del salario basico si este esta entre 2 y 4 salarios minimos, del 13% si es mayor a 4 salarios minimos y de 0 si es menor a dos salarios minimos
- el seguro social ($social_securirty) se debe descontar y debe ser el 4% del valor del salario basico para todos los empleados
- las horas extras ($extra_hours) deben valer el doble que una hora normal y se calcula multiplicando por la diferencia de horas luego de las 48
- el salario_neto ($net_pay) sera entonces el resultado de las sumas y restas necesarias de las variables anteriores
