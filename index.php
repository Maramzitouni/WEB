<!DOCTYPE html>
<html id="html-id"  dir="ltr" lang="fr-FR">
    <head>
        <meta charset="utf-8" />
        <title>LoyaltyCard</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">



</head>
<body>
  <form action="notification.php" method="post">
      <input type ="hidden" name="app_id" value="cf719161-1c43-4981-9810-59f56b29465c">
      <input type ="hidden" name="points" value="1000">
      <input type ="submit" name="send_all" value="send to all users">

  </form>
  <form action="notification.php" method="post">
    <input type="text" name="heading">
    <textarea name="message"> </textarea>
    <input type ="hidden" name="app_id" value="cf719161-1c43-4981-9810-59f56b29465c">
     <input type="hidden" name="user_id" id="user_id">
    <input type ="submit" name="send_by_id" value="send to connected user">

  </form>
</body>



</html>
<script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async=""></script>
<script>
  window.OneSignal = window.OneSignal || [];
  OneSignal.push(function() {
    OneSignal.init({
      appId: "cf719161-1c43-4981-9810-59f56b29465c",
    });
  });
</script>

<script>
OneSignal.push(function() {
  /* These examples are all valid */
  var isPushSupported = OneSignal.isPushNotificationsSupported();
  if (isPushSupported) {
    // Push notifications are supported
    console.log('supported');
    OneSignal.isPushNotificationsEnabled(function(isEnabled) {
          if (isEnabled){
              console.log("Push notifications are enabled!");
              OneSignal.getUserId(function(userId) {
              console.log("OneSignal User ID:", userId);
             // (Output) OneSignal User ID: 270a35cd-4dda-4b3f-b04e-41d7463a2316
              document.getElementById('user_id').value=userId;
             });
          }else{
               console.log("Push notifications are not enabled yet.");
               OneSignal.push(function() {
               OneSignal.showNativePrompt();
                });
              }
       });
  } else {
    // Push notifications are not supported
    console.log('Not supported');
  }
});
</script>
