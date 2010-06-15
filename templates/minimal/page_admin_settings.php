<div class="pageoutline">
  <div class="outlinetitle">page_admin_settings.php</div>

  <moatag type="AdminLinks" location="admin">
  <br/><br/>
  <div>
    <div>
      <div>
        <div>
          <p>Settings</p>
          <div id="tagblock">
            <form method="post" action="index.php?action=admin_settings" id="settings_form" enctype="multipart/form-data">
  		        <p id="settings_general_title">
  		            General settings.
  		        </p>
  		        <div id="settings_general">
  		          <input type="hidden" name="moa_form_submitted" value="true"/>
  		          <dl>
  		            <dt>
  		              Display a popup for items with no description.
  		            </dt>
  		            <dd>
  		              <input type="checkbox" name="setting_ShowEmptyDescPopups" <moatag type="SettingsValue_ShowEmptyDescPopups">/>
  		            </dd>
  
  		            <dt>
  		              What text to show in the popup for blank descriptions if the above box is ticked.
  		            </dt>
  		            <dd>
  		              <input type="text" name="setting_EmptyDescPopupText" id="setting_EmptyDescPopupText" value="<moatag type="SettingsValue_EmptyDescPopupText">"/>
  		            </dd>
  
  		            <dt>
  		              Length of description in the browser title bar.
  		            </dt>
  		            <dd>
  		              <input type="text" name="setting_TitleDescLength" id="setting_TitleDescLength" value="<moatag type="SettingsValue_TitleDescLength">"/>
  		            </dd>
  
  		            <dt>
  		              What character to use to split up a list of tags (example "tag1,tag2,tag3" would be a "," character).
  		            </dt>
  		            <dd>
  		              <input type="text" name="setting_StrDelimiter" id="setting_StrDelimiter" value="<moatag type="SettingsValue_StrDelimiter">"/>
  		            </dd>
  		          </dl>
  		        </div>
  
  		        <p id="settings_visual_title">
  		          Visual settings.
  		        </p>
  		        <div id="settings_visual">
  		          <dl>
  		            <dt>
  		              Template.
  		            </dt>
  		            <dd>
  		              <select name="setting_Template">
  		                <moatag type="SettingsValue_Template" style="select">
  		              </select>
  		            </dd>
  
  		            <dt>
  		              Width of thumbnails in pixels.
  		            </dt>
  		            <dd>
  		              <input type="text" name="setting_ThumbWidth" id="setting_ThumbWidth" value="<moatag type="SettingsValue_ThumbWidth">"/>
  		            </dd>
  
  		            <dt>
  		              Width of image preview (on view image page) in pixels.
  		            </dt>
  		            <dd>
  		              <input type="text" name="setting_ConfigDisplayMaxWidth" id="setting_ConfigDisplayMaxWidth" value="<moatag type="SettingsValue_ConfigDisplayMaxWidth">"/>
  		            </dd>
  
  		            <dt>
  		              Hide image thumbnails if a subgallery is present.
  		            </dt>
  		            <dd>
  		              <input type="checkbox" name="setting_DisplayPlainSubgalleries" <moatag type="SettingsValue_DisplayPlainSubgalleries">/>
  		            </dd>
  		          </dl>
  		        </div>
  
                  <div class="outline">
  		          <moatag type="SettingsDatabaseForm">
  		        </div>
  		        <dl>
  		          <dt>
  		          </dt>
  		          <dd>
  		            <input type="submit" id="settings_submit" class="abc def" value="Save"/>
  		          </dd>
  		        </dl>
  		      </form>
  		      <dl>
  		        <dt>
  		        </dt>
  		        <dd id="submit_container">
  		        </dd>
  		      </dl>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>