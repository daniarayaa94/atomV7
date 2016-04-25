/**
 * Created by niko_ on 22/04/2016.
 */
$("a[id*='confirmar']").on('click',function () {
    alert($(this).prop('id'));
});
