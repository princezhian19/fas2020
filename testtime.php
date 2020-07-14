<div>
  <label>
    <input type="checkbox" class="check1" /> Checkbox 1
  </label>
  <label>
    <input type="checkbox" class="check2" /> Checkbox 2
  </label>
  <label>
    <input type="checkbox" class="check3" /> Checkbox 3
  </label>
</div>

<br />
<div class="target"></div>
<script>
$(function() {
  $('input[type="checkbox"]').on('change', function() {
    var isCheck1Checked = $('.check1').prop('checked');
    var isCheck2Checked = $('.check2').prop('checked');
    var isCheck3Checked = $('.check3').prop('checked');
    var text, c = 0;
    if (!isCheck1Checked && !isCheck2Checked && !isCheck3Checked) {
      text = '';
    } else if (isCheck1Checked && isCheck2Checked && isCheck3Checked) {
      text = "The height is 2500px";
      c = 300;
    } else if ((isCheck1Checked && isCheck2Checked) || (isCheck2Checked && isCheck3Checked) || (isCheck1Checked && isCheck3Checked) && !(    isCheck1Checked && isCheck2Checked && isCheck3Checked)) {
      text = "The height is 2000px";
      c = 200;
    } else {
      text = "The height is 1500px";
      c = 50;
    }
  });
});


</script>
