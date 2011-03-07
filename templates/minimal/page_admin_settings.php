<div class="pageoutline">
  <div class="outlinetitle">page_admin_settings.php</div>

  <moatag type="AdminLinks" location="admin">
  <br/><br/>

  <p>Settings</p>
  <form method="post" action="index.php?action=admin_settings" id="settings_form" enctype="multipart/form-data">
    <p id="settings_general_title">
        General settings.
    </p>
    <div id="settings_general">
      <fieldset>
        <input type="hidden" name="moa_form_submitted" value="true"/>
        
        <label for="setting_ShowEmptyDescPopups" class="formLabel">
          <span class="formLabelTextNewLine">Display a popup for items with no description.</span>
          <img src="templates/minimal/media/help.png" title="<moatag type="FormPopupHelp" field="setting_show_popups">" />
          <input type="checkbox" name="setting_ShowEmptyDescPopups" id="setting_ShowEmptyDescPopups" <moatag type="SettingsValue_ShowEmptyDescPopups">/>
        </label>

        <label for="setting_EmptyDescPopupText" class="formLabel">
          <span class="formLabelTextNewLine">What text to show in the popup for blank descriptions if the above box is ticked.</span>
          <img src="templates/minimal/media/help.png" title="<moatag type="FormPopupHelp" field="setting_empty_desc_popup">" />
          <input type="text" name="setting_EmptyDescPopupText" id="setting_EmptyDescPopupText" value="<moatag type="SettingsValue_EmptyDescPopupText">"/>
        </label>

        <label for="setting_TitleDescLength" class="formLabel">
          <span class="formLabelTextNewLine">Length of trimmed description.</span>
          <img src="templates/minimal/media/help.png" title="<moatag type="FormPopupHelp" field="setting_title_desc_length">" />
          <input type="text" name="setting_TitleDescLength" id="setting_TitleDescLength" value="<moatag type="SettingsValue_TitleDescLength">"/>
        </label>

        <label for="setting_StrDelimiter" class="formLabel">
          <span class="formLabelTextNewLine">What character to use to split up a list of tags.</span>
          <img src="templates/minimal/media/help.png" title="<moatag type="FormPopupHelp" field="setting_str_delimiter">" />
          <input type="text" name="setting_StrDelimiter" id="setting_StrDelimiter" value="<moatag type="SettingsValue_StrDelimiter">"/>
        </label>
      </fieldset>
    </div>

    <p id="settings_visual_title">
      Visual settings.
    </p>
    <div id="settings_visual">
      <fieldset>
        <label for="setting_Template" class="formLabel">
          <span class="formLabelTextNewLine">Template.</span>
          <img src="templates/minimal/media/help.png" title="<moatag type="FormPopupHelp" field="setting_template">" />
          <select name="setting_Template">
            <moatag type="SettingsValue_Template" style="select">
          </select>
        </label>

        <label for="setting_ThumbWidth" class="formLabel">
          <span class="formLabelTextNewLine">Width of thumbnails in pixels.</span>
          <img src="templates/minimal/media/help.png" title="<moatag type="FormPopupHelp" field="setting_thumb_width">" />
          <input type="text" name="setting_ThumbWidth" id="setting_ThumbWidth" value="<moatag type="SettingsValue_ThumbWidth">"/>
        </label>

        <label for="setting_ConfigDisplayMaxWidth" class="formLabel">
          <span class="formLabelTextNewLine">Width of image preview (on view image page) in pixels.</span>
          <img src="templates/minimal/media/help.png" title="<moatag type="FormPopupHelp" field="setting_preview_width">" />
          <input type="text" name="setting_ConfigDisplayMaxWidth" id="setting_ConfigDisplayMaxWidth" value="<moatag type="SettingsValue_ConfigDisplayMaxWidth">"/>
        </label>

        <label for="setting_DisplayPlainSubgalleries" class="formLabel">
          <span class="formLabelTextNewLine">Hide image thumbnails if a subgallery is present.</span>
          <img src="templates/minimal/media/help.png" title="<moatag type="FormPopupHelp" field="setting_plain_subgalleries">" />
          <input type="checkbox" name="setting_DisplayPlainSubgalleries" <moatag type="SettingsValue_DisplayPlainSubgalleries">/>
        </label>
      </fieldset>
    </div>

        <div class="outline">
      <moatag type="SettingsDatabaseForm">
    </div>
    </fieldset>
      <input type="submit" id="settings_submit" class="abc def" value="Save"/>
      
      <div id='setting_TitleDescLengthcomment' class='invalidfieldcomment invalidfieldstyle'>'Length of description in title bar' must be a number.</div>
      <div id='setting_StrDelimitercomment' class='invalidfieldcomment invalidfieldstyle'>The tag-splitting character must be set.</div>
      <div id='setting_ThumbWidthcomment' class='invalidfieldcomment invalidfieldstyle'>The thumbnail width must be a number.</div>
      <div id='setting_ConfigDisplayMaxWidthcomment' class='invalidfieldcomment invalidfieldstyle'>Image preview width must be a number.</div>
      <div id='setting_MoaPathcomment' class='invalidfieldcomment invalidfieldstyle'>Path to Moa must be set and a valid path.</div>
      <div id='setting_ImagePathcomment' class='invalidfieldcomment invalidfieldstyle'>Path to images must be set and a valid relative path.</div>
      <div id='setting_ThumbPathcomment' class='invalidfieldcomment invalidfieldstyle'>Path to thumbnails must be set and a valid relative path.</div>
      <div id='setting_CookiePathcomment' class='invalidfieldcomment invalidfieldstyle'>Path to cookies must be set and a valid URL path.</div>
      <div id='setting_IncomingPathcomment' class='invalidfieldcomment invalidfieldstyle'>Path to incoming files must be set and a valid relative path.</div>
      <div id='setting_CookieNamecomment' class='invalidfieldcomment invalidfieldstyle'>The cookie name must be set.</div>
      <div id='setting_DBHostcomment' class='invalidfieldcomment invalidfieldstyle'>Database host must be set (probably 'localhost').</div>
      <div id='setting_DBNamecomment' class='invalidfieldcomment invalidfieldstyle'>Database name must be set.</div>
      <div id='setting_DBUsercomment' class='invalidfieldcomment invalidfieldstyle'>Database user must be set.</div>
      <div id='setting_DBPasscomment' class='invalidfieldcomment invalidfieldstyle'>Database password must be set.</div>
      <div id='setting_TabPrefixcomment' class='invalidfieldcomment invalidfieldstyle'>Database table prefix must be set.</div>
    </fieldset>
  </form>
</div>