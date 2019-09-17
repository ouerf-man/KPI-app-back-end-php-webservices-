<?php
/**
 * Created by PhpStorm.
 * User: Raed
 * Date: 16/09/2019
 * Time: 14:15
 */

require_once("functions/function.php");
get_header();
get_sidebar();
get_bread_three();
?>
<style>
    .chat {
        list-style: none;
        margin: 0;
        padding: 0;
    }

    .chat li {
        margin-bottom: 10px;
        padding-bottom: 5px;
        border-bottom: 1px dotted #B3A9A9;
    }

    .chat li.left .chat-body {
        margin-left: 60px;
    }


</style>

<?php
require_once('includes/connextionBD.php');

$sql = "SELECT * FROM messages ORDER BY createdAt DESC LIMIT 30";
$bd = connextionBD::getInstance(); //rs.open sql,con
$stmt = $bd->query($sql);
while ($row = $stmt->fetch())
{
extract($row); ?><!--open of while -->
    <ul class="chat">
        <li class="left clearfix"><span class="chat-img pull-left">
                            <img src="http://placehold.it/50/55C1E7/fff&text=U" alt="User Avatar" class="img-circle"/>
                        </span>
            <div class="chat-body clearfix">
                <div class="header">
                    <strong class="primary-font"><?php echo $email ?></strong>
                    <small class="pull-right text-muted">
                        <span class="glyphicon glyphicon-time"></span><?php echo $createdAt ?>
                    </small>
                </div>
                <p>
                <h5><?php echo $subject ?></h5>
                <?php echo $message ?>
                </p>
                <a href="<?php echo '#myModal'.$id ?>" role="button" data-toggle="modal" class="btn btn-danger">reply</a>
            </div>
        </li>
    </ul>
    <div id="<?php echo 'myModal'.$id ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 id="myModalLabel">send message</h3>
        </div>
        <form action="actions/send_msg.php" method="post">
            <div class="modal-body">
                <div class="control-group">
                    <label class="control-label" for="focusedInput">subject:</label>
                    <div class="controls">
                        <input class="input-xlarge focused" name="subject" id="focusedInput" required type="text"
                               placeholder="subject"
                        >
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="focusedInput">message:</label>
                    <div class="controls">
                    <textarea name="message" class="input-xlarge focused" id="focusedInput" required cols="80"
                              rows="10"></textarea>
                    </div>
                </div>
                <input type="hidden" value="<?php echo $email ?>" name="email">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                <button type="submit" class="btn btn-primary">Send</button>
            </div>
        </form>
    </div>

<?php
}
get_footer();
?>
