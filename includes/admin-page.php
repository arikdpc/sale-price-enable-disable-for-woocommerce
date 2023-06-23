<div class="wrap">
    <h2>Disable/Enable Sale Prices</h2>

    <label for="per_page">Products per Operation:</label>
    <input type="number" id="per_page" value="100" min="1">

    <button id="disable_sale_prices" class="button button-primary">Disable Sale Prices</button>
    <button id="restore_sale_prices" class="button button-secondary">Restore Sale Prices</button>

    <div id="message"></div>
</div>

<script type="text/javascript">
    jQuery(document).ready(function ($) {
        var per_page = $('#per_page').val();
        var disableButton = $('#disable_sale_prices');
        var restoreButton = $('#restore_sale_prices');
        var messageDiv = $('#message');

        disableButton.click(function () {
            disableButton.prop('disabled', true);
            messageDiv.html('Processing...');
            processPage(1, 'des_disable_sale_prices');
        });

        restoreButton.click(function () {
            restoreButton.prop('disabled', true);
            messageDiv.html('Processing...');
            processPage(1, 'des_restore_sale_prices');
        });

        function processPage(page, action) {
            $.ajax({
                url: ajaxurl,
                type: 'POST',
                data: {
                    action: action,
                    per_page: per_page,
                    page: page,
                },
                success: function (res) {
                    if (res.done) {
                        var successMessage = action === 'des_disable_sale_prices' ? 'Sale prices were disabled successfully.' : 'Sale prices were restored successfully.';
                        messageDiv.html(successMessage);
                        disableButton.prop('disabled', false);
                        restoreButton.prop('disabled', false);
                    } else {
                        processPage(page + 1, action);
                    }
                }
            });
        }
    });
</script>
