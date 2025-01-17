/* ------------------------------------------
Multiple Form Group
------------------------------------------ */
$(document).ready(function () {

    function addFormGroup (event) {
        event.preventDefault();

        var $formGroup = $(this).closest('.form-group');
        var $multipleFormGroup = $formGroup.closest('.multiple-form-group');
        var $formGroupClone = $formGroup.clone();

        $(this)
            .toggleClass('btn-success btn-add btn-danger btn-remove')
            .html('–');

        $formGroupClone.find('input').val('');
        $formGroupClone.find('.concept').text('Phone');
        $formGroupClone.insertAfter($formGroup);

        var $lastFormGroupLast = $multipleFormGroup.find('.form-group:last');
        if ($multipleFormGroup.data('max') <= countFormGroup($multipleFormGroup)) {
            $lastFormGroupLast.find('.btn-add').attr('disabled', true);
        }
    };

    function removeFormGroup (event) {
        event.preventDefault();

        var $formGroup = $(this).closest('.form-group');
        var $multipleFormGroup = $formGroup.closest('.multiple-form-group');

        var $lastFormGroupLast = $multipleFormGroup.find('.form-group:last');
        if ($multipleFormGroup.data('max') >= countFormGroup($multipleFormGroup)) {
            $lastFormGroupLast.find('.btn-add').attr('disabled', false);
        }

        $formGroup.remove();
    };

    function selectFormGroup (event) {
        event.preventDefault();

        var $selectGroup = $(this).closest('.input-group-select');
        var param = $(this).attr("href").replace("#","");
        var concept = $(this).text();

        $selectGroup.find('.concept').text(concept);
        $selectGroup.find('.input-group-select-val').val(param);

    }

    function countFormGroup ($form) {
        return $form.find('.form-group').length;
    };

    $(document).on('click', '.btn-add', addFormGroup);
    $(document).on('click', '.btn-remove', removeFormGroup);
    $(document).on('click', '.dropdown-menu a', selectFormGroup);

    //Student data
    function addStudentData()
    {
        var dst = $('.dataStudentList option:selected').val();
        var act = $('.cloudDataForm').attr('action');

        $('.cloudDataForm').attr('action', act+dst)

        return true;
    }
    $('.addCloudData').on('click', addStudentData);

    //Student data
    function changeStudentData()
    {
        var dst = $('.dataStudentList option:selected').val();

        window.location = 'http://sporcu.info/admin/cloudData/'+dst;

        return true;
    }
    $('.switchUser').on('click', changeStudentData);

})