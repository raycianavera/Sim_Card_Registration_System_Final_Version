const reportForm = document.querySelector('form#form')

reportForm.addEventListener('submit', e => {
  e.preventDefault()

  console.log(reportForm)
  const imageFile = document.querySelector('input#nso-attach').files[0]
  const imageFile1 = document.querySelector('input#id-attach').files[0]
  const imageFile2 = document.querySelector('input#exampleFormControlFile1').files[0]
  console.log(imageFile)
  const formData = new FormData()
  formData.append('image', imageFile,imageFile1,imageFile2)
  const config = {
      headers: {
          "Content-Type" : "multipart/form-data"
      }
  }
  axios.post('https://testcode-wendell.herokuapp.com/api/NSOUpload', formData, config)
    .then(response => {
      console.log(response)
      if (response.status === 200) {
        var bodyFormData = new FormData();
        bodyFormData.append('address', document.querySelector('input#address').value);
        bodyFormData.append('simcard', document.getElementById('dropSimType').value);
        bodyFormData.append('simnum', document.querySelector('input#simnum').value);
        bodyFormData.append('services', document.getElementById('dropSimTelco').value);
        bodyFormData.append('dateofregis', document.querySelector('input#address').value);
        bodyFormData.append('retailer', document.querySelector('input#regisite').value);
        bodyFormData.append('ImageUrl', response.data.imageUrl);
        bodyFormData.append('register', 'submit');
        axios({
            method: "post",
            url: "https://sim-registration-php.herokuapp.com/UserprofileBackEnd/BackEnd_Report.php",
            data: bodyFormData,
            headers: { "Content-Type": "multipart/form-data" },
        }).then(response => {
            console.log(response)                         
            window.location.href = response.request.responseURL   
    
        })
      } 
    })
    .catch(reason => {
        const error = reason.response.data.error
        switch (error) {
            case 'No file attached':
                window.location.href = './profile-user.php?reportPage&ReportStatus=imageempty'
                break
            case 'File too large':
                window.location.href = './profile-user.php?reportPage&ReportStatus=imagelarge'
                break
            case 'Invalid data type':
                window.location.href = './profile-user.php?reportPage&ReportStatus=imageformaterror'
                break
        }
    })
})