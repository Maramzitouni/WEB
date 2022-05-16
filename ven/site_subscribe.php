<div class="starter-template">
                <h1>OneSignal  Subscription</h1>
                <p class="lead">User Subscribe Page</p>
            </div>

            <div class="contact-form">

                <p class="notice error"><?= $this->session->flashdata('error_msg') ?></p><br/>

                <form id="ServiceRequest" action="<?= base_url() ?>quotes/send_message" method='post'>

                    <div class="form-group">
                        <label class="control-label">Message Body:</label>
                        <input type="text" name="message" class="form-control" placeholder="Add Your Message" value="" >
                    </div>
                    <div class="form-group">
                        <label class="control-label">Message Body:</label>
                        <input type="text" name="user_id" class="form-control" readonly value="4444" >
                    </div>
                    <div id='submit_button'>
                        <input class="btn btn-success" type="submit" name="submit" value="Send data"/>
                    </div>
                </form>
            </div>

        <script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async></script>
        <script>
            var OneSignal = window.OneSignal || [];
            OneSignal.push(["init", {
                appId: "88df922d-ee38-4ed1-a11d-e64b49828d7a",
                subdomainName: 'ourtutorial',
                autoRegister: true,
                promptOptions: {
                    /* These prompt options values configure both the HTTP prompt and the HTTP popup. */
                    /* actionMessage limited to 90 characters */
                    actionMessage: "We'd like to show you notifications for the latest news.",
                    /* acceptButtonText limited to 15 characters */
                    acceptButtonText: "ALLOW",
                    /* cancelButtonText limited to 15 characters */
                    cancelButtonText: "NO THANKS"
                }
            }]);
        </script>
        <script>
            function subscribe() {
                // OneSignal.push(["registerForPushNotifications"]);
                OneSignal.push(["registerForPushNotifications"]);
                event.preventDefault();
            }
            function unsubscribe(){
                OneSignal.setSubscription(true);
            }

            var OneSignal = OneSignal || [];
            OneSignal.push(function() {
                /* These examples are all valid */
                // Occurs when the user's subscription changes to a new value.
                OneSignal.on('subscriptionChange', function (isSubscribed) {
                    console.log("The user's subscription state is now:", isSubscribed);
                    OneSignal.sendTag("user_id","4444", function(tagsSent)
                    {
                        // Callback called when tags have finished sending
                        console.log("Tags have finished sending!");
                    });
                });

                var isPushSupported = OneSignal.isPushNotificationsSupported();
                if (isPushSupported)
                {
                    // Push notifications are supported
                    OneSignal.isPushNotificationsEnabled().then(function(isEnabled)
                    {
                        if (isEnabled)
                        {
                            console.log("Push notifications are enabled!");

                        } else {
                            OneSignal.showHttpPrompt();
                            console.log("Push notifications are not enabled yet.");
                        }
                    });

                } else {
                    console.log("Push notifications are not supported.");
                }
            });


        </script>
