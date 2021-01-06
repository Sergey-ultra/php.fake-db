let createRecord = document.forms.create_record
let fields = createRecord.querySelectorAll('.field')

createRecord.onsubmit = function (e){
    e.preventDefault()
    let isValidate = true
    let xhr = new XMLHttpRequest();
    let data = new FormData(createRecord)

//проверка поля на соответствие integer, если поле задано как integer
    let fieldCell
    fields.forEach( input => {
        if (input.name !== 'table_name' && input.name !== 'db_name'){
            if (input.name.includes('_type') && input.name.includes(fieldCell.name) && input.value === 'integer'){
                if (isNaN(Number(fieldCell.value))){
                    isValidate = false
                    fieldCell.classList.add('error_border')
                    fieldCell.insertAdjacentHTML('beforebegin',
                        `<div class="error">
                                    Должно быть введено число                                 
                            </div>`)
                }
            }
            if (!input.name.includes('_type')){
                fieldCell = input
            }
        }
    })

    xhr.open('POST','../../logic/create_record.php')


    xhr.onload = function (){
        if (xhr.readyState === 4 && xhr.status === 200){
            createRecord.reset();
            location.reload()
        }
    }
    //если валидация прошла - отправляем поля
    if (isValidate){
        xhr.send(data)
    }
}