import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

//Echo.channel => Public channel
//app.event.my-event //if not .
var channel = Echo.private(`App.Models.User.${userId}`); //Lisen Private Changel
channel.notification( function(data) {  //app.event.my-event
    // console.log(data);
    // alert(data.body)
    // alert(JSON.stringify(data)); //All Data
    // console.log('Abd');
    Swal.fire(
        JSON.stringify(data['body']),
        'Thank You clicked the button!',
        'success'
      )

});
