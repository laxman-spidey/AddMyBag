'use strict';

/*
 * angular-google-plus-directive v0.0.2
 * ♡ CopyHeart 2013 by Jerad Bitner http://jeradbitner.com
 * Copying is an act of love. Please copy.
 * Modified by Boni Gopalan to include Google oAuth2 Login.
 * Modified by @barryrowe to provide flexibility in clientid, and rendering
 *  --loads auth2 and runs init() so clientid can still be defined as an attribute
 *  --attribute 'autorender' added. Defaults to true; if false gapi.signin2.render() 
 *    won't be called on the element
 *  --attribute 'customtargetid' added. Allows any custom element id to be the target of
 *    attachClickHandler() if 'autorender' is set to false
 *  --if 'autorender' is false and no 'customtargetid' is set, a decently styled button is
 *    rendered into the directive root element (requires inclusion of supporting css)
 */

AuthModule.
  directive('googlePlusSignin', ['$window', '$rootScope', function ($window, $rootScope) {
      var ending = /\.apps\.googleusercontent\.com$/;

      return {
          restrict: 'E',
          transclude: true,
          template: '<span></span>',
          replace: true,
          link: function (scope, element, attrs, ctrl, linker) {
              attrs.clientid += (ending.test(attrs.clientid) ? '' : '.apps.googleusercontent.com');
              attrs.$set('data-clientid', attrs.clientid);
              var defaults = {
                
                  onsuccess: onSignIn,
                  cookiepolicy: 'single_host_origin',
                  onfailure: onSignInFailure,
                  scope: 'profile email',
                  longtitle: true,
                  theme: 'dark',
                  height: 40,
                  width: 250,
                  autorender: true,
                  
                  //customtargetid: 'googlebutton'
                  
                  /*
                  'scope': 'profile email',
                  'cookiepolicy': 'single_host_origin',
                  'width': 240,
                  'height': 50,
                  'longtitle': true,
                  'theme': 'dark',
                  'autorender': true
                  'onsuccess': onSignIn,
                  'onfailure': onSignInFailure,
                  'customtargetid': 'googlebutton'
                  */
              };

              defaults.clientid = attrs.clientid;

              // Overwrite default values if explicitly set
              angular.forEach(Object.getOwnPropertyNames(defaults), function (propName) {
                  if (attrs.hasOwnProperty(propName)) {
                      defaults[propName] = attrs[propName];
                  }
              });
              var isAutoRendering = (defaults.autorender !== undefined && (defaults.autorender === 'true' || defaults.autorender === true));
              if (!isAutoRendering && defaults.customtargetid === "googlebutton") {
                  console.log("element", element);
                  console.log("rendering");
                  element[0].innerHTML =
                  
                  ' <span id="googlebutton" class="sign-in-text">sign in with google</span>' 
                  ;
              }

              // Default language
              // Supported languages: https://developers.google.com/+/web/api/supported-languages
              attrs.$observe('language', function (value) {
                  $window.___gcfg = {
                      lang: value ? value : 'en'
                  };
              });

              // Some default values, based on prior versions of this directive
              function onSignIn(authResult) {
                  $rootScope.$broadcast('event:google-plus-signin-success', authResult);
              };
              function onSignInFailure() {
                  $rootScope.$broadcast('event:google-plus-signin-failure', null);
              };

              // Asynchronously load the G+ SDK.
              var po = document.createElement('script');
              po.type = 'text/javascript';
              po.async = true;
              po.src = 'https://apis.google.com/js/client:platform.js';
              //var s = document.getElementsByTagName('script')[0];
              var s = document.getElementById('googleSignIn');
              s.parentNode.insertBefore(po, s);

              linker(function (el, tScope) {
                  po.onload = function () {
                      if (el.length) {
                          element.append(el);
                      }
                      //Initialize Auth2 with our clientId
                      gapi.load('auth2', function () {
                          var googleAuthObj =
                          gapi.auth2.init({
                              client_id: defaults.clientid,
                              cookie_policy: defaults.cookiepolicy
                          });

                          if (isAutoRendering) {
                              gapi.signin2.render(element[0], defaults);
                          } else {
                              googleAuthObj.attachClickHandler(defaults.customtargetid, {}, defaults.onsuccess, defaults.onfailure);
                          }
                      });
                  };
              });

          }
      }
  }])
;