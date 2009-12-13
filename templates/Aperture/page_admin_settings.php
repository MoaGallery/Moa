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

      <form method="post" action="index.php?action=admin_settings" id="settings_form" enctype="multipart/form-data">
        <p class="settings_section_break" id="settings_general_title">
            General settings.
        </p>
        <div id="settings_general" class="settings_block">
          <input type="hidden" name="moa_form_submitted" value="true"/>
          <dl class="settings_form_items">
            <dt class='settings_label_text'>
              Display a popup for items with no description.
            </dt>
            <dd>
              <input type="checkbox" name="setting_ShowEmptyDescPopups" value="on" <moatag type="SettingsValue_ShowEmptyDescPopups">/>
            </dd>

            <dt class='settings_label_text'>
              What text to show in the popup for blank descriptions if the above box is ticked.
            </dt>
            <dd>
              <input type="text" name="setting_EmptyDescPopupText" id="setting_EmptyDescPopupText" value="<moatag type="SettingsValue_EmptyDescPopupText">"/>
            </dd>

            <dt class='settings_label_text'>
              Length of description in the browser title bar.
            </dt>
            <dd>
              <input type="text" name="setting_TitleDescLength" id="setting_TitleDescLength" value="<moatag type="SettingsValue_TitleDescLength">"/>
            </dd>

            <dt class='settings_label_text'>
              What character to use to split up a list of tags (example "tag1,tag2,tag3" would be a "," character).
            </dt>
            <dd>
              <input type="text" name="setting_StrDelimiter" id="setting_StrDelimiter" value="<moatag type="SettingsValue_StrDelimiter">"/>
            </dd>
          </dl>
        </div>

        <p class="settings_section_break"  id="settings_visual_title">
          Visual settings.
        </p>
        <div id="settings_visual" class="settings_block">
          <dl class="settings_form_items">
            <dt class='settings_label_text'>
              Template.
            </dt>
            <dd>
              <select name="setting_Template">
                <moatag type="SettingsValue_Template" style="select">
              </select>
            </dd>

            <dt class='settings_label_text'>
              Width of thumbnails in pixels.
            </dt>
            <dd>
              <input type="text" name="setting_ThumbWidth" id="setting_ThumbWidth" value="<moatag type="SettingsValue_ThumbWidth">"/>
            </dd>

            <dt class='settings_label_text'>
              Width of image preview (on view image page) in pixels.
            </dt>
            <dd>
              <input type="text" name="setting_ConfigDisplayMaxWidth" id="setting_ConfigDisplayMaxWidth" value="<moatag type="SettingsValue_ConfigDisplayMaxWidth">"/>
            </dd>

            <dt class='settings_label_text'>
              Hide image thumbnails if a subgallery is present.
            </dt>
            <dd>
              <input type="checkbox" name="setting_DisplayPlainSubgalleries" value="on" <moatag type="SettingsValue_DisplayPlainSubgalleries">/>
            </dd>
          </dl>
        </div>

        <moatag type="SettingsDatabaseForm">
        <dl class="settings_form_items">
          <dt>
          </dt>
          <dd>
            <input type="submit" id="settings_submit" value="Save"/>
          </dd>
        </dl>
      </form>
      <dl class="settings_form_items">
        <dt>
        </dt>
        <dd id="submit_container">
        </dd>
      </dl>
    </div>
  </div>
</div>

<script type="text/javascript" src="sources/common.js"></script>
<script type="text/javascript" src="templates/Aperture/javascript/settings.js"></script>