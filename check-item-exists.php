
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.1/css/bootstrap.min.css">
    <style>
	body {
	    background-image: url('https://images.wallpapersden.com/image/download/abstract-shapes-2021-minimalist_bG1lZm6UmZqaraWkpJRnamtlrWZpaWU.jpg');
	    background-repeat: no-repeat;
	    background-size: cover;
	}
        .form-container {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0px 0px 20px 0px rgba(0,0,0,0.2);
            padding: 30px;
        }
        .form-container h1 {
            font-size: 2.5rem;
            font-weight: bold;
            color: #007bff;
        }
        .form-container label {
            font-size: 1.2rem;
            font-weight: bold;
            color: #555;
        }
        .form-container input[type="nombre"], .form-container input[type="password"] {
            border-radius: 5px;
            padding: 10px;
            border: none;
            box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.2);
        }
        .form-container input[type="nombre"]:focus, .form-container input[type="password"]:focus {
            box-shadow: 0px 0px 10px 0px rgba(0,0,255,0.5);
            outline: none;
        }
        .form-container .btn-primary {
            background-color: #007bff;
            border: none;
            box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.2);
        }
        .form-container .btn-primary:hover {
            background-color: #0056b3;
        }
        .form-container .mt-2 {
            font-size: 0.9rem;
            color: #888;
        }
        .form-container .mt-2 a {
            color: #007bff;
            text-decoration: none;
        }
        .form-container .mt-2 a:hover {
            text-decoration: underline;
        }
    </style>
<body>
<div class="container-fluid justify-content-center align-items-center">
  <div class="form-container">
    <div class="col-md-8">
      <form id="myForm" method="POST">
        <div class="form-group">
          <br><br><br>
          <h1 class="text-center mb-4">Enter your required data</h1>
          <label for="name">Name:</label>
          <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="form-group">
          <label for="email">Email:</label>
          <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="form-group">
          <label for="message">Message:</label>
          <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
        </div>
        <br>
        <div class="row justify-content-center">
        <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>
      </body>
<script>
  const form = document.getElementById("myForm");

  form.addEventListener("submit", (event) => {
    event.preventDefault();
    const name = document.getElementById("name").value;
    const email = document.getElementById("email").value;
    const message = document.getElementById("message").value;

    // Send the data to the server using fetch
    fetch("/submit", {
      method: "POST",
      headers: {
        "Content-Type": "application/json"
      },
      body: JSON.stringify({ name, email, message })
    })
    .then(response => {
      if (!response.ok) {
        throw new Error("Network response was not ok");
      }
      return response.json();
    })
    .then(data => {
      alert("Message sent successfully!");
      form.reset();
    })
    .catch(error => {
      console.error("Error sending message:", error);
      alert("There was an error sending your message. Please try again later.");
    });
  });
</script>
