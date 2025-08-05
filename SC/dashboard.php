<?php
session_start();
require 'include/connect.php';

if (isset($_SESSION['user_id']) && $_SESSION['role'] === 'Admin') {
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin - Add Bamboo</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="include/style1.css">
  <style>
    body::before {
      content: "";
      position: absolute;
      top: 0; left: 0;
      width: 100%; height: 100%;
      background: url('img/kawa-back3.png') no-repeat center top;
      background-size: 100% auto;
      opacity: 0.03;
      z-index: -1;
    }


    .navbar a:hover {
      text-decoration: underline;
    }

    form {
      max-width: 700px;
      margin: 40px auto;
      background: #f9f9f9;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }

    label {
      display: block;
      font-weight: bold;
      margin-top: 20px;
      color: #143b04;
    }

    textarea, input[type="text"], select {
      width: 100%;
      padding: 12px;
      margin-top: 5px;
      border: 1px solid #ccc;
      border-radius: 6px;
      font-size: 14px;
      font-family: inherit;
      resize: vertical;
    }

    textarea {
      min-height: 100px;
    }

    .upload-box {
      background: #e0e0e0;
      padding: 20px;
      text-align: center;
      margin-top: 10px;
      border-radius: 6px;
    }

    .upload-box i {
      font-size: 40px;
      color: #143b04;
    }

    button {
      margin-top: 30px;
      padding: 12px 30px;
      background-color: #143b04;
      color: white;
      border: none;
      border-radius: 6px;
      font-size: 16px;
      font-weight: bold;
      cursor: pointer;
    }

    button:hover {
      background-color: #1e4f0a;
    }

    .subtitle {
      text-align: center;
      color: #333;
      margin-top: 10px;
    }

    .province-container {
      border: 1px solid #ccc;
      padding: 10px;
      max-height: 150px;
      overflow-y: auto;
      background-color: #fff;
      border-radius: 6px;
      margin-top: 5px;
    }

    .province-container label {
      display: block;
      font-weight: normal;
      margin: 3px 0;
    }

    @media screen and (max-width: 768px) {
      form {
        margin: 20px;
        padding: 20px;
      }
    }
  </style>
</head>
<body>

<div class="navbar">
  <img src="img/KAWAYANIHAN.png" alt="Logo" class="logo">
  <div>
    <a href="#">ViewAll</a>
    <a href="logout.php">Logout</a>
  </div>
</div>

<h2 style="text-align:center;">WELCOME ADMIN</h2>
<p class="subtitle">
  Enter a bamboo species to share its characteristics, structure, uses, and the locations where it thrives.
</p>

<form action="process_bamboo.php" method="POST" enctype="multipart/form-data">
  <label>Different species of bamboo</label>
  <textarea name="species" placeholder="Enter details..." required></textarea>

  <label>Morphological properties of bamboo</label>
  <textarea name="morphology" placeholder="Enter details..." required></textarea>

  <label>Characteristics and the structures</label>
  <textarea name="structure" placeholder="Enter details..." required></textarea>

  <label>Uses of bamboo</label>
  <textarea name="uses" placeholder="Enter details..." required></textarea>

  <label>Propagation method</label>
  <textarea name="propagation" placeholder="Enter details..." required></textarea>

  <label>Cultivation Requirements</label>
  <textarea name="cultivation" placeholder="Enter details..." required></textarea>

  <label>Country</label>
  <select name="country" disabled>
    <option value="Philippines" selected>Philippines</option>
  </select>
  <input type="hidden" name="country" value="Philippines" />

  <label>Region/Province</label>
  <div class="province-container" id="provinceList"></div>
  <input type="hidden" name="region" id="selectedProvinces">

  <label>Image</label>
  <div class="upload-box">
    <i class="fa-solid fa-image"></i><br>
    <span>UPLOAD IMAGE HERE</span>
    <input type="file" name="image" accept="image/*" required>
  </div>

  <button type="submit">Add</button>
</form>

<script>
const provinces = [
  "Agusan del Norte", "Agusan del Sur", "Aklan", "Albay", "Antique", "Aurora", "Basilan", "Bataan", "Batanes", "Batangas",
  "Biliran", "Bohol", "Bukidnon", "Bulacan", "Cagayan", "Camarines Norte", "Camarines Sur", "Camiguin", "Capiz", "Catanduanes",
  "Cavite", "Cebu", "Compostela Valley", "Davao del Norte", "Davao del Sur", "Davao Occidental", "Davao Oriental",
  "Dinagat Islands", "Eastern Samar", "Guimaras", "Ilocos Norte", "Ilocos Sur", "Iloilo", "Isabela", "La Union",
  "Laguna", "Lanao del Norte", "Lanao del Sur", "Leyte", "Maguindanao", "Marinduque", "Masbate", "Metro Manila",
  "Misamis Occidental", "Misamis Oriental", "Mindoro Occidental", "Mindoro Oriental", "Negros Occidental", "Negros Oriental",
  "Northern Samar", "Nueva Ecija", "Nueva Vizcaya", "Palawan", "Pampanga", "Pangasinan", "Quezon", "Quirino", "Rizal",
  "Romblon", "Samar", "Siquijor", "Sorsogon", "Southern Leyte", "Sulu", "Surigao del Norte", "Surigao del Sur",
  "Tarlac", "Tawi-Tawi", "Zambales", "Zamboanga del Norte", "Zamboanga del Sur", "Zamboanga Sibugay"
].sort();

const container = document.getElementById('provinceList');
const hiddenInput = document.getElementById('selectedProvinces');

provinces.forEach(province => {
  const label = document.createElement('label');
  label.innerHTML = `<input type="checkbox" value="${province}" onchange="updateProvinces()"> ${province}`;
  container.appendChild(label);
});

function updateProvinces() {
  const selected = [];
  const checkboxes = container.querySelectorAll('input[type="checkbox"]:checked');
  checkboxes.forEach(checkbox => selected.push(checkbox.value));
  hiddenInput.value = selected.join(', ');
}
</script>

</body>
</html>
<?php
} else {
  echo "<script>window.open('index.php','_self');</script>";
}
?>
