<!-- app/View/Users/login.ctp -->

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <!-- Include CSS stylesheets or styles here -->
    <style>
        body { font-family: Arial, sans-serif; }
        .form-container { max-width: 400px; margin: 0 auto; }
        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; margin-bottom: 5px; }
        .form-group input[type="text"], .form-group input[type="password"] { width: 100%; padding: 8px; }
        .form-group .error-message { color: red; font-size: 12px; }
        .form-group .submit-btn { background-color: #007bff; color: #fff; border: none; padding: 10px 20px; cursor: pointer; }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Login</h2>
        <?php
            echo $this->Form->create('User', array('url',array('action' => 'login')));
            echo $this->Form->input('username', array('label' => 'Username', 'class' => 'form-control'));
            echo $this->Form->input('password', array('label' => 'Password', 'type' => 'password', 'class' => 'form-control'));
            echo $this->Form->end('Login', array('class' => 'submit-btn'));
        ?>
        <div class="error-message">
            <?php echo $this->Session->flash('auth'); ?>
        </div>
    </div>
</body>
</html>
