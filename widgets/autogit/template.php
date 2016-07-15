<style>
#autogit-widget .btn {
  margin-bottom: .5em;
  width: 100%; }

#autogit-widget footer {
  color: #777;
  font-size: .8em;
  margin-top: .5em;
  text-align: right; }

.autogit-action[disabled] {
  color: #ddd;
  cursor: not-allowed;
  border-color: #ddd; }

.autogit-action[disabled]:hover {
  background-color: transparent; }

.autogit-status, .autogit-warning  {
  margin-bottom: .75em;
  margin-top: .5em;
  text-align: center; }

.autogit-status  {
  display: none; }

.autogit-warning {
  color: #b3000a; }

.icon-left.fa-spinner {
  margin-right: .5em;
  padding-right: 0 !important; }

.icon.fa-spinner {
  -webkit-animation: spinner .8s infinite linear;
          animation: spinner .8s infinite linear;
  -webkit-transform-origin: 50% 46%;
          transform-origin: 50% 46%; }

@-webkit-keyframes spinner {
  0% {
    -webkit-transform: rotate(0);
            transform: rotate(0); }
  100% {
    -webkit-transform: rotate(360deg);
            transform: rotate(360deg); } }
</style>

<div class="autogit-widget">
  <?php if (autogit()->hasRemote()) : ?>
    <button href="/panel/autogit/push" data-action="push" class="btn btn-rounded btn-positive autogit-action">
      <i class="icon icon-left fa fa-cloud-upload"></i>
      Publish changes
    </button>
    <button href="/panel/autogit/pull" data-action="pull" class="btn btn-rounded btn-positive autogit-action">
      <i class="icon icon-left fa fa-cloud-download"></i>
      Get latest changes
    </button>
    <div class="autogit-status"></div>
  <?php else : ?>
    <div class="autogit-warning">
      Could not detect remote repository <strong><?php echo c::get('autogit.remote.name') ?></strong>.
    </div>
  <?php endif; ?>
  <footer>Powered by Auto Git</footer>
</div>

<script>
  var $widget = $('#autogit-widget')
  var $loadingIcon = $('<i class="icon icon-left fa fa-spinner" />')
  var $successIcon = $('<i class="icon icon-left fa fa-check" />')
  var $errorIcon = $('<i class="icon icon-left fa fa-times" />')

  $widget.find('.autogit-action').click(function (event) {
    if (event.target !== this) event.target = this

    var $button = $(event.target)
    var $otherButton = $widget.find('.autogit-action').not(event.target)
    var $defaultIcon = $button.find('.icon')
    var $status = $('.autogit-status')

    $button.find('.icon').replaceWith($loadingIcon)
    $otherButton.prop('disabled', true)

    $.post('/panel/autogit/' + $button.data('action'))
      .done(function (res) {
        $button.find('.icon').replaceWith($successIcon)
        $status.text(res.message).show(600)
      })
      .fail(function (res) {
        $button.find('.icon').replaceWith($errorIcon)
        $button.removeClass('btn-positive').addClass('btn-negative')
        $status.text(res.responseJSON.message).show(600)
      })
      .always(function () {
        setTimeout(function () {
          $button.find('.icon').replaceWith($defaultIcon)
          $button.removeClass('btn-negative').addClass('btn-positive')
          $otherButton.prop('disabled', false)
          $status.hide(600, function () {
            $(this).text('')
          })
        }, 6000)
      })
    })
</script>
