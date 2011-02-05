<div class="body_section">
  <div class="left_column left_column_shadow">
    <moatag type="AdminLinks" location="admin">
    <br/>
    <div id='tagblockfeedback'><moatag type="SettingsFeedback"></div>
  </div>
  <div class="right_column right_column_shadow">
    <div class="content_wrapper">
      <h1>
          Settings
      </h1>
      <br/>

      <form method="post" action="index.php?action=admin_settings" id="settings_form" name="settings_form" enctype="multipart/form-data">
        <label for="settings_general" class="settings_section_break" id="settings_general_title">
          General settings.
        </label>
        <fieldset id="settings_general" class="formSettingsFieldset settings_block">
          <input type="hidden" name="moa_form_submitted" value="true"/>
          <ul class="formListSettings">
            <li>
              <label for="setting_EmptyDescPopups" class="formLabelSettings">
                Display a popup for items with no description?
              </label>
              <img src="templates/Aperture/media/help.png" class="popupImage" title="<moatag type="FormPopupHelp" field="setting_show_popups">" alt="popup help" />
              <input type="checkbox" name="setting_ShowEmptyDescPopups" value="on" id="setting_EmptyDescPopups" <moatag type="SettingsValue_ShowEmptyDescPopups">/>
            </li>

            <li>
              <label for="setting_EmptyDescPopupText" class="formLabelSettings">
               Blank description popup text.
              </label>
              <img src="templates/Aperture/media/help.png" class="popupImage" title="<moatag type="FormPopupHelp" field="setting_empty_desc_popup">" alt="popup help" />
              <input type="text" name="setting_EmptyDescPopupText" id="setting_EmptyDescPopupText" value="<moatag type="SettingsValue_EmptyDescPopupText">"/>
            </li>

            <li>
              <label for="setting_TitleDescLength" class="formLabelSettings">
                Length of shortened description.
              </label>
              <img src="templates/Aperture/media/help.png" class="popupImage" title="<moatag type="FormPopupHelp" field="setting_title_desc_length">" alt="popup help" />
              <input type="text" name="setting_TitleDescLength" id="setting_TitleDescLength" value="<moatag type="SettingsValue_TitleDescLength">"/>
            </li>

            <li>
              <label for="setting_StrDelimiter" class="formLabelSettings">
                What character to use to split tags.
              </label>
              <img src="templates/Aperture/media/help.png" class="popupImage" title="<moatag type="FormPopupHelp" field="setting_str_delimiter">" alt="popup help" />
              <input type="text" name="setting_StrDelimiter" id="setting_StrDelimiter" value="<moatag type="SettingsValue_StrDelimiter">"/>
            </li>
          </ul>
        </fieldset>
        
        <ul class="settingsErrorList">
          <li id='setting_TitleDescLengthcomment' class='invalidfieldcomment invalidfieldstyle'>'Length of description in title bar' must be a number.</li>
          <li id='setting_StrDelimitercomment' class='invalidfieldcomment invalidfieldstyle'>The tag-splitting character must be set.</li>
        </ul>

        <label for="settings_visual" class="settings_section_break" id="settings_visual_title">
          Visual settings.
        </label>
        <fieldset id="settings_visual" class="formSettingsFieldset settings_block">
          <ul class="formListSettings">
            <li>
              <label for="setting_Template" class="formLabelSettings">
                Template.
              </label>
              <img src="templates/Aperture/media/help.png" class="popupImage" title="<moatag type="FormPopupHelp" field="setting_template">" alt="popup help" />
              <select name="setting_Template" id="setting_Template">
                <moatag type="SettingsValue_Template" style="select">
              </select>
            </li>

            <li>
              <label for="setting_ThumbWidth" class="formLabelSettings">
                Width of thumbnails in pixels.
              </label>
              <img src="templates/Aperture/media/help.png" class="popupImage" title="<moatag type="FormPopupHelp" field="setting_thumb_width">" alt="popup help" />
              <input type="text" name="setting_ThumbWidth" id="setting_ThumbWidth" value="<moatag type="SettingsValue_ThumbWidth">"/>
            </li>

            <li>
              <label for="setting_ConfigDisplayMaxWidth" class="formLabelSettings">
                Width of image preview (on view image page) in pixels.
              </label>
              <img src="templates/Aperture/media/help.png" class="popupImage" title="<moatag type="FormPopupHelp" field="setting_preview_width">" alt="popup help" />
              <input type="text" name="setting_ConfigDisplayMaxWidth" id="setting_ConfigDisplayMaxWidth" value="<moatag type="SettingsValue_ConfigDisplayMaxWidth">"/>
            </li>

            <li>
              <label for="setting_ConfigDisplayMaxWidth" class="formLabelSettings">
                Hide image thumbnails if a subgallery is present.
              </label>
              <img src="templates/Aperture/media/help.png" class="popupImage" title="<moatag type="FormPopupHelp" field="setting_plain_subgalleries">" alt="popup help" />
              <input type="checkbox" name="setting_DisplayPlainSubgalleries" value="on" <moatag type="SettingsValue_DisplayPlainSubgalleries">/>
            </li>
          </ul>
        </fieldset>
        
        <ul class="settingsErrorList">
          <li id='setting_ThumbWidthcomment' class='invalidfieldcomment invalidfieldstyle'>The thumbnail width must be a number.</li>
          <li id='setting_ConfigDisplayMaxWidthcomment' class='invalidfieldcomment invalidfieldstyle'>Image preview width must be a number.</li>
        </ul>  

        <moatag type="SettingsDatabaseForm">
        <ul class="formButtonsSettings">
          <li>
            <input type="submit" id="settings_submit" value="Save"/>
          </li>
        </ul>
      </form>
    </div>
  </div>
</div>

<script type="text/javascript" src="templates/Aperture/javascript/settings.js"></script>