<script>
    $(document).ready(function() {
        $("#datepicker").datetimepicker({
            dateFormat: "yy-mm-dd",
            timeFormat: 'HH:mm:ss',
            changeMonth: true,
            changeYear: true,
			timezone: '{!! Carbon\Carbon::now()->utcOffset() !!}',
        });
    });
</script>
