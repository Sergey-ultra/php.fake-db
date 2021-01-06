let createTable = document.forms.create_table
let addField =  document.querySelector('.add_field')
let deleteField =  document.querySelector('.delete_field')
let createTableInput =  document.querySelector('.create_table_input')
let createTableArray =  document.querySelectorAll('.create_table_field')


createTable.onsubmit = function (e){
    e.preventDefault()

    let xhr = new XMLHttpRequest();
    let formData = new FormData(createTable)


    xhr.open('POST','../../logic/create_table.php')

    xhr.onload = function (){
        if (xhr.readyState === 4 && xhr.status === 200){
            createTable.reset();
            location.reload()
        }
    }
    xhr.send(formData)
}

let inputNumber = 1;

addField.onclick = function (){
    inputNumber ++;
    createTableInput.insertAdjacentHTML('beforeend',
        `<div class="create_table_field">
                    Название поля 
                    <input type="text" name="field_name${inputNumber}" maxlength="64" required="required">                 
                    Тип поля
                    <select  name="field_type${inputNumber}">                 
                        <option value="integer">integer</option>
                        <option value="string">string</option>                      
                        <option value="boolean">boolean</option>
                        <option value="NULL">NULL</option>
                    </select>               
                </div>`)

}

deleteField.onclick = function (){
    if(inputNumber >1){
        console.log(createTableArray.length)
        createTableInput.lastElementChild.remove()
        createTable.reset();
        inputNumber--
    }
}



