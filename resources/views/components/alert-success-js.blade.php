<script>
    $(function () {
        $("input.btn").click(function () {
            $("input.btn").hide("slow");
            $(".alert").show("slow")
        });
        $(".close").click(function () {
            $(".alert").hide("slow");
            $("input.btn").show()
        })
    })
</script>
