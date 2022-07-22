function validarInput(index, cantidadCaracteres){
    //Siempre el primer parámetro es el index de cada input, y va variando por input
    //Es decir, si tengo dos campos a completar, el primero tendrá indice 0 como primer parámetro, el segundo indice 1
    //Y asi sucesivamente
    //El segundo parámetro son la cantidad de caracteres permitidos en la DB para ese input
    inputsText = document.getElementsByClassName("inputText");

    valueInput = inputsText[index].value;
    
    //Analizar depende los campos si es necesario que vaya o no la validacion con 0, total está el required del HTML
    //en caso de necesitarlo obligatoriamente
    if(valueInput.length > cantidadCaracteres || valueInput.length <= 0){
        campoInvalido(inputsText[index], cantidadCaracteres);
    }
    else{
        campoValido(inputsText[index]);
    }
    
}

function campoValido(input){
    input.classList.add("inputSuccess");

    removeAttributes(input)

    if(input.classList.contains("inputError")){
        input.classList.remove("inputError");
    }
    
}

function campoInvalido(input, cantidadCaracteres){
    input.classList.add("inputError");
    
    //Le agrego los atributos para el tooltip
    if(input.value == ""){
        setAttributes(input, {"data-toggle": "tooltip", "data-placement": "top", "title": ``, "data-original-title": ``});
    }
    else{
        setAttributes(input, {"data-toggle": "tooltip", "data-placement": "top", "title": `Los caracteres ingresados superan los ${cantidadCaracteres} caracteres permitidos`, "data-original-title": `Los caracteres ingresados superan los ${cantidadCaracteres} caracteres permitidos`});
    }

    if(input.classList.contains("inputSuccess")){
        input.classList.remove("inputSuccess");
    }
}

function setAttributes(input, options) {
    Object.keys(options).forEach(function(attr) {
      input.setAttribute(attr, options[attr]);
    })

    //Lo ejecuto
    $('[data-toggle="tooltip"]').tooltip();
}

function removeAttributes(input) {
    $(input).removeAttr('data-toggle');
    $(input).removeAttr('data-placement');
    $(input).removeAttr('title');
    $(input).removeAttr('data-original-title');
}

function validateSubmit(form, name) {
    var allInputsForm   = document.forms[name].elements;

    //Armo esa var de arriba como array
    var arrayInputsForm = Array.from(allInputsForm);

    //Necesito ignorar el ultimo elemento que seria el boton submit y los dos primeros que son USUARIO_M Y FECHA_M
    //Esto se usa siempre y cuando tenga los campos USUARIO_M y FECHA_M
    arrayInputsForm = deleteInnecesaryInputs(arrayInputsForm);

    //Recorro todos los elementos del array que queda para ver si hay alguno en rojo
    for (var i = 0; i < arrayInputsForm.length; i++) {
        if(arrayInputsForm[i].classList.contains("inputError")){
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Por favor corrija los campos que están incorrectos (en rojo)',
            });
            return false;
        }
    }

    form.submit();
}

function deleteInnecesaryInputs(arrayInputsForm){
    arrayInputsForm.shift();
    arrayInputsForm.shift();
    arrayInputsForm.pop();
    
    return arrayInputsForm;
}

