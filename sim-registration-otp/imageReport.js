const reportForm = document.querySelector('form#form')

reportForm.addEventListener('submit', e => {
  e.preventDefault()

  console.log(reportForm)
  const imageFile = document.querySelector('input#exampleFormControlFile1').files[0]
  console.log(imageFile)
  const formData = new FormData()
  formData.append('image', imageFile)
  const config = {
      headers: {
          "Content-Type" : "multipart/form-data"
      }
  }
  axios.post('https://testcode-wendell.herokuapp.com/api/upload', formData, config)
    .then(response => {
      console.log(response)
      if (response.status === 200) {
        var bodyFormData = new FormData();
        bodyFormData.append('ReportedNumber', document.querySelector('input#reportedMobilenumber').value);
        bodyFormData.append('Remarks', document.querySelector('textarea#textArea').value);
        bodyFormData.append('ImageUrl', response.data.imageUrl);
        bodyFormData.append('reportbutton', 'submit');
        axios({
            method: "post",
            url: "https://sim-registration-php.herokuapp.com/UserprofileBackEnd/BackEnd_Report.php",
            data: bodyFormData,
            headers: { "Content-Type": "multipart/form-data" },
        })
      } 
    })
    .catch(reason => {
        alert('Invalid OTP : ' + reason.message)
        console.log(reason)
    })
})


// <form class='' id='form' action='UserprofileBackEnd/Back_End_User_Profile.php' method='POST'>
