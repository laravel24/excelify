require('./bootstrap');
var currentButton;

var vm = new Vue({
    el:'#app',
    data:{
        mapData:""
    },
    methods: {
        addColumn: function(){
            divColumn = $(".columnslot div:eq(0)").clone();
            divColumn.removeClass('hide');
            $("div.columnslot").append(divColumn);
        },
       addMap: function(){
        $(currentButton).closest("[name='fieldKvMap[]']").hide();
        $(currentButton).parent().prev().val(this.mapData);
        $("#modal-arrayMap").modal('hide');
       // name="fieldKvMap[]"
       } 
    },
});
$("#app").on('click','button.btnDelete', function(){
    $(this).closest('div.form-inline').remove();
});

$("#modal-arrayMap").on('show.bs.modal', function(event){
    currentButton = event.relatedTarget;
    vm.mapData = $(currentButton).parent().prev().val();

});