<?php
defined('MYAAC') or die('Direct access not allowed!');
?>
<div class="well">
    <div class="header">
        Follow Us
    </div>
    <div class="body">
        <table class="smedia centralizeContent table-100">
            <tr>
                <td>
                    <a href="<?=config('follow_facebook')?>" target="_blank">
                        <i class="fab fa-facebook" style="font-size:24px;"></i>
                    </a>
                </td>
                <td>
                    <a href="<?=config('follow_discord')?>" target="_blank">
                        <i class="fab fa-discord" style="font-size:24px;"></i>
                    </a>
                </td>
            </tr>
        </table>
    </div>
</div>

<!-- Dodaj poniższą linię do sekcji <head> strony, jeśli jeszcze jej nie masz -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
