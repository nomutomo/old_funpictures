<!-- cookie コピっただけ。まだカスタマイズしていない。-->
<script>
  var page;
  var table = ["01", "02", "03", "04", "05", "06", "07", "08", "09"];
  
  function init() {
    sort_table = getTable();

    for (i = 0; i < sort_table.length; i++) {
      $('#listWithHandle').append(createHtml(sort_table[i]));
    }
  }

  function getTable() {
    $.cookie.json = true;
    page = $.cookie('page.page01');

    var sort_table;
    if(page !== undefined) {
      sort_table = page;
    } else {
      sort_table = table;
    }

    return sort_table;
  }

  function createHtml(name) {
    return '<div class="wrap list-group-item" data-name="' + name + '">' +
           '<span class="icon-move" aria-hidden="true">#</span>' + name +
           '</div>';
  }

  $(function(){
    init();

    Sortable.create(listWithHandle, {
      handle: '.icon-move',
      animation: 150,
      onUpdate: function (e) {
        var box = [];
        $('.wrap').each(function(index, element){
          box.push($(element).data('name'));
        });
        $.cookie('page.page01', box);
      },
    });
  });
</script>