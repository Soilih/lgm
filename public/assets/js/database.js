$(document).ready(function(){
 
   // SmartWizard initialize
   $('#smartwizard').smartWizard({
    selected: 0 , 
    theme: 'arrows' , 
    height: 500 , 
    keyboardSettings: {
      keyNavigation: true,
      keyLeft: [74], // J key code
      keyRight: [75] 
    } , 
    transition: {
      animation: 'slide-horizontal', // Effect on navigation, none/fade/slide-horizontal/slide-vertical/slide-swing
      speed: '4000', // Transion animation speed
      easing:'' // Transition animation easing. Not supported without a jQuery easing plugin
    }, 

   });
  
 });