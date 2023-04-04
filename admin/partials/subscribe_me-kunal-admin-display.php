<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://kunalsaha@wisdmlabs.com
 * @since      1.0.0
 *
 * @package    Subscribe_me_Kunal
 * @subpackage Subscribe_me_Kunal/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->


<?php

function menu_page_html()
{

    // global $wpdb;
    // $table_name = $wpdb->prefix . 'events';

    // $results = $wpdb->get_results("SELECT * FROM $table_name WHERE date >= DATE( NOW() ) ORDER BY date");

    $emails = get_option('my_sub_email', array());


    echo '<center><table class="sm-table" border="1">
    <thead>
        <th>Subscriber Count</th>
    </thead>
    <tbody>
        <tr>
        <td>' . count($emails) . '</td></tr>
    </tbody>
</table></center>
';

    echo '<br><br>';

    echo '
    <div>
    <table class="sm-table" border="1" cell-spacing="0">
        <thead>
            <th>Email IDs</th>
        </thead>
        <tbody>';
    foreach ($emails as $record) {
        echo '
        <tr>
            <td>' .
            $record
            . '
        </td>
        </tr>
    ';
    }

    echo '</tbody>
    </table>
    </div>
    ';
}

?>
