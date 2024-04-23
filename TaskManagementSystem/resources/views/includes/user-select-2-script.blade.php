<script>
try {

        const optionFormat = (item) => {
        if (!item.id) {
            return item.text;
        }
    
        var span = document.createElement('span');
        var template = '';
    
        template += '<div class="d-flex align-items-center p-2" style="width:220px !important;">';
        template += '<img src="' + item.element.getAttribute('data-kt-rich-content-icon') + '" class="rounded-circle h-10 me-3" alt="' + item.text + '"/>';
        template += '<div class="d-flex flex-column">'
        template += '<span class="">' + item.element.getAttribute('data-kt-rich-content-subcontent') + '</span>';
        template += '</div>';
        template += '</div>';
    
        span.innerHTML = template;
    
        return $(span);
        }
    
        // Init Select2 --- more info: https://select2.org/
        $('.assign_user').select2({
        templateSelection: optionFormat,
        templateResult: optionFormat
        });
  } catch (error) {
  
  }
</script>