I. CONCLUSIONES
¿Qué ventajas tiene usar dataProvider frente a escribir pruebas individuales para cada caso?
La principal ventaja es que no tengo que repetir código. Escribo la prueba una sola vez y el dataProvider se encarga de enviarle diferentes datos. Así el código queda más limpio y es mucho más fácil de actualizar.

¿Cómo se manejan las excepciones dentro de un dataProvider?
Si hay un error al intentar cargar los datos, uso un try-catch dentro del proveedor para que el programa no se caiga. Si lo que quiero es probar que mi código falle a propósito (un error esperado), lo valido dentro de la misma prueba usando también un try-catch.

¿Qué tipo de datos debe retornar el método proveedor?
Debe retornar una matriz o arreglo bidimensional de objetos (Object[][]). Básicamente, cada fila de la matriz es una ejecución de la prueba y cada columna representa el dato que le estoy mandando.

¿Qué dificultades tuviste al implementar las pruebas parametrizadas?
Lo que más me costó fue hacer coincidir exactamente el orden y el tipo de datos (texto, números, etc.) entre el dataProvider y mi método de prueba. Si me equivocaba y mandaba un texto donde iba un número, la prueba fallaba de inmediato.