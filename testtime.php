<script>
("#regForm").validate({
      debug: true,
      rules: {
        agreeForm: "required",
      },
      messages: {
        agreeForm: "Please accept our Terms and Conditions.",
      }
    });
</script>
<form id="regForm">
<input type="radio" name="terms" id="terms1" value="Yes!" class="required" title="Must accept terms to continue" /> Yes
<input type="radio" name="terms" id="terms2" value="No" class="required" title="Must accept terms to continue" /> No
<input type = "submit" value = "a"/>
</form>