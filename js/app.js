function somar(){
    
    var num1;
    var num2;
    var resultado;

    num1 = parseInt(document.getElementById('num1').value);
    num2 = parseInt(document.getElementById('num2').value);

    resultado = document.getElementById("resultado");

    resultado.value = num1 + num2;
}


function buscarEndereco(){

    var cep = document.getElementById('cep').value;
    var endereco = document.getElementById('endereco');

    var url = `https://viacep.com.br/ws/${cep}/json/`;
    
    fetch(url)
      .then( resp => resp.json() )
      .then( resp => endereco.value = resp.logradouro + ", " + resp.bairro + " - " + resp.localidade + "/" + resp.uf);

}