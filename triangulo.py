def main():
    a= int(input("Ingrese el valor de a: "))
    b= int(input("Ingrese el valor de b: "))
    c= (a*b)/2
    print("El valor de c es: ", c)

    # TODO: Verificar si el triangulo es isoseles
    if a == b:
        print("Es un triangulo isoseles")
    else:
        print("No es un triangulo isoseles")
main()      