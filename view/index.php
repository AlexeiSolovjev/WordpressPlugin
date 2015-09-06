<?php if($notification) echo $notification;?>
<form name="form" id="form" method="post" action="">
    <label for="name">Name</label>
    <input type="text" class="form-control" id="contact_name" placeholder="Name" name="contact_name" autocomplete="off">
    <div class="clear"></div>
    <?php
        global $wpdb;
        $categories = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."categories");
    ?>
    <div class="clear"></div>
    <label for="category">Category</label>
    <select id="category" name="category">
        <?php foreach ($categories AS $category):?>
            <option value="<?php echo $category->id;?>"><?php echo $category->category;?></option>
        <?php endforeach;?>
    </select>
    <div class="clear"></div>
    <label for="email">Email</label>
    <input type="text" class="form-control" id="email" placeholder="Email" name="email"  autocomplete="off">

    <div class="clear"></div>
    <label for="message">Message</label>
    <textarea name="message" id="message" autocomplete="off"></textarea>

    <button type="input" class="btn btn-success submit">Submit</button>
</form>
<script src="https://code.jquery.com/jquery-1.8.3.js"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.14.0/jquery.validate.js"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.14.0/additional-methods.js"></script>
<script>
    $(document).ready(function() {
        $("#form").validate({
            errorElement: 'span',
            rules: {
                name: {
                    required: true,
                    maxlength: 100,
                },
                email: {
                    required: true,
                    email: true
                },
            },
            messages: {
                name: {
                    required: 'This field is required',
                    maxlength: "Length can't be longer then 100 symbols",

                },
                email: {
                    required: 'This field is required',
                    email: "Email is invalid "
                },
            }
        });
    });
</script>
