export default function Tag(){
    $(document).on('click', '.addTag', (event) => {
        event.preventDefault();
        $("<div class='col-sm-12 p-2'><input type='text' required class='form-control' name='tag[]' id='tag'></div>").appendTo($(".tagFieldForm"));
    })
}








