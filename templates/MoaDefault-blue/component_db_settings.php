        <label for="settings_server" class="settings_section_break" id="settings_server_title">
          Server settings.
        </label>
        <fieldset id="settings_server" class="formSettingsFieldset settings_block">
          <ul class="formListSettings">
            <li>
              <label for="setting_MoaPath" class="formLabelSettings">
                Absolute path on server to Moa.
              </label>
              <img src="templates/MoaDefault-blue/media/help.png" class="popupImage" title="<moatag type="FormPopupHelp" field="setting_moapath">" alt="popup help" />
              <input type="text" name="setting_MoaPath" id="setting_MoaPath" value="<moatag type="SettingsValue_MoaPath">"/>
            </li>

            <li>
              <label for="setting_ImagePath" class="formLabelSettings">
                Relative path on server to the images.
              </label>
              <img src="templates/MoaDefault-blue/media/help.png" class="popupImage" title="<moatag type="FormPopupHelp" field="setting_imagepath">" alt="popup help" />
              <input type="text" name="setting_ImagePath" id="setting_ImagePath" value="<moatag type="SettingsValue_ImagePath">"/>
            </li>

            <li>
              <label for="setting_ThumbPath" class="formLabelSettings">
                Relative path on server to the thumbnails.
              </label>
              <img src="templates/MoaDefault-blue/media/help.png" class="popupImage" title="<moatag type="FormPopupHelp" field="setting_thumbpath">" alt="popup help" />
              <input type="text" name="setting_ThumbPath" id="setting_ThumbPath" value="<moatag type="SettingsValue_ThumbPath">"/>
            </li>

            <li>
              <label for="setting_CookiePath" class="formLabelSettings">
                URL path to Moa (for cookies).
              </label>
              <img src="templates/MoaDefault-blue/media/help.png" class="popupImage" title="<moatag type="FormPopupHelp" field="setting_cookiepath">" alt="popup help" />
              <input type="text" name="setting_CookiePath" id="setting_CookiePath" value="<moatag type="SettingsValue_CookiePath">"/>
            </li>

            <li>
              <label for="setting_CookieName" class="formLabelSettings">
                Cookie name.
              </label>
              <img src="templates/MoaDefault-blue/media/help.png" class="popupImage" title="<moatag type="FormPopupHelp" field="setting_cookiename">" alt="popup help" />
              <input type="text" name="setting_CookieName" id="setting_CookieName" value="<moatag type="SettingsValue_CookieName">"/>
            </li>

            <li>
              <label for="setting_IncomingPath" class="formLabelSettings">
                Relative server path for FTP \ archive upload.
              </label>
              <img src="templates/MoaDefault-blue/media/help.png" class="popupImage" title="<moatag type="FormPopupHelp" field="setting_incomingpath">" alt="popup help" />
              <input type="text" name="setting_IncomingPath" id="setting_IncomingPath" value="<moatag type="SettingsValue_IncomingPath">"/>
            </li>
          </ul>
        </fieldset>
        
        <ul class="settingsErrorList">
          <li id='setting_MoaPathcomment' class='invalidfieldcomment invalidfieldstyle'>Path to Moa must be set and a valid path.</li>
          <li id='setting_ImagePathcomment' class='invalidfieldcomment invalidfieldstyle'>Path to images must be set and a valid relative path.</li>
          <li id='setting_ThumbPathcomment' class='invalidfieldcomment invalidfieldstyle'>Path to thumbnails must be set and a valid relative path.</li>
          <li id='setting_CookiePathcomment' class='invalidfieldcomment invalidfieldstyle'>Path to cookies must be set and a valid URL path.</li>
          <li id='setting_CookieNamecomment' class='invalidfieldcomment invalidfieldstyle'>The cookie name must be set.</li>
          <li id='setting_IncomingPathcomment' class='invalidfieldcomment invalidfieldstyle'>Path to incoming files must be set and a valid relative path.</li>
        </ul>


        <label for="settings_db" class="settings_section_break" id="settings_db_title">
          Database settings.
        </label>
        <fieldset id="settings_db" class="formSettingsFieldset settings_block">
          <ul class="formListSettings">
            <li>
              <label for="setting_DBHost" class="formLabelSettings">
                Database host.
              </label>
              <img src="templates/MoaDefault-blue/media/help.png" class="popupImage" title="<moatag type="FormPopupHelp" field="setting_dbhost">" alt="popup help" />
              <input type="text" name="setting_DBHost" id="setting_DBHost" value="<moatag type="SettingsValue_DBHost">"/>
            </li>

            <li>
              <label for="setting_DBName" class="formLabelSettings">
                Database name.
              </label>
              <img src="templates/MoaDefault-blue/media/help.png" class="popupImage" title="<moatag type="FormPopupHelp" field="setting_dbname">" alt="popup help" />
              <input type="text" name="setting_DBName" id="setting_DBName" value="<moatag type="SettingsValue_DBName">"/>
            </li>

            <li>
              <label for="setting_DBUser" class="formLabelSettings">
                Database username.
              </label>
              <img src="templates/MoaDefault-blue/media/help.png" class="popupImage" title="<moatag type="FormPopupHelp" field="setting_dbuser">" alt="popup help" />
              <input type="text" name="setting_DBUser" id="setting_DBUser" value="<moatag type="SettingsValue_DBUser">"/>
            </li>

            <li>
              <label for="setting_DBPass" class="formLabelSettings">
                Database password.
              </label>
              <img src="templates/MoaDefault-blue/media/help.png" class="popupImage" title="<moatag type="FormPopupHelp" field="setting_dbpass">" alt="popup help" />
              <input type="text" name="setting_DBPass" id="setting_DBPass" value="<moatag type="SettingsValue_DBPass">"/>
            </li>

            <li>
              <label for="setting_TabPrefix" class="formLabelSettings">
                Database prefix.
              </label>
              <img src="templates/MoaDefault-blue/media/help.png" class="popupImage" title="<moatag type="FormPopupHelp" field="setting_tabprefix">" alt="popup help" />
              <input type="text" name="setting_TabPrefix" id="setting_TabPrefix" value="<moatag type="SettingsValue_TabPrefix">"/>
            </li>
          </ul>
        </fieldset>
        
        <ul class="settingsErrorList">
          <li id='setting_DBHostcomment' class='invalidfieldcomment invalidfieldstyle'>Database host must be set (probably 'localhost').</li>
          <li id='setting_DBNamecomment' class='invalidfieldcomment invalidfieldstyle'>Database name must be set.</li>
          <li id='setting_DBUsercomment' class='invalidfieldcomment invalidfieldstyle'>Database user must be set.</li>
          <li id='setting_DBPasscomment' class='invalidfieldcomment invalidfieldstyle'>Database password must be set.</li>
          <li id='setting_TabPrefixcomment' class='invalidfieldcomment invalidfieldstyle'>Database table prefix must be set.</li>
        </ul> 