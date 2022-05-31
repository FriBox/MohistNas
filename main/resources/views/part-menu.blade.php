                    <!-- ================================================================ -->
                    <td style="width:250px;padding-left:8px;padding-right:8px;border:none;border-right:#cdcdcd 1px solid;height:640px;" valign="top">
                    <div class="accordion" id="accordionPanelsStayOpenExample" style="padding-top:10px;padding-bottom:10px;width:230px;">
                      
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                                <button style="padding-top:10px;padding-bottom:10px;" class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                                    {{ __('main.menu_system') }}
                                </button>
                            </h2>
                            <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingOne">
                                <div class="accordion-body" style="padding-top:10px;padding-bottom:10px;">
                                    <a href="/index" class="<?php if ($xUri=='index') {echo 'AdminMenuItemNow';} else { echo 'AdminMenuItem';} ?>" >{{ __('main.menu_index') }}</a>
                                    <a href="/preferences" class="<?php if ($xUri=='preferences') {echo 'AdminMenuItemNow';} else { echo 'AdminMenuItem';} ?>" >{{ __('main.menu_preferences') }}</a>

                                    <a href="" class="<?php if ($xUri=='01') {echo 'AdminMenuItemNow';} else { echo 'AdminMenuItem';} ?>" >Storage Pool</a>
                                    <a href="" class="<?php if ($xUri=='01') {echo 'AdminMenuItemNow';} else { echo 'AdminMenuItem';} ?>" >S.M.A.R.T.</a>

                                    <a href="/log" class="<?php if ($xUri=='log') {echo 'AdminMenuItemNow';} else { echo 'AdminMenuItem';} ?>" >{{ __('main.menu_log') }}</a>

                                    <a href="/gologout" class="<?php if ($xUri=='gologout') {echo 'AdminMenuItemNow';} else { echo 'AdminMenuItem';} ?>" >{{ __('main.menu_gologout') }}</a>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
                                <button style="padding-top:10px;padding-bottom:10px;" class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
                                    {{ __('main.menu_storage') }}
                                </button>
                            </h2>
                            <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingTwo">
                                <div class="accordion-body" style="padding-top:10px;padding-bottom:10px;">
                                    <a href="" class="<?php if ($xUri=='01') {echo 'AdminMenuItemNow';} else { echo 'AdminMenuItem';} ?>" >FTP / SFTP</a>
                                    <a href="" class="<?php if ($xUri=='02') {echo 'AdminMenuItemNow';} else { echo 'AdminMenuItem';} ?>" >SMB</a>
                                    <a href="" class="<?php if ($xUri=='02') {echo 'AdminMenuItemNow';} else { echo 'AdminMenuItem';} ?>" >AFP</a>
                                    <a href="" class="<?php if ($xUri=='03') {echo 'AdminMenuItemNow';} else { echo 'AdminMenuItem';} ?>" >ISCSI</a>
                                    <a href="" class="<?php if ($xUri=='04') {echo 'AdminMenuItemNow';} else { echo 'AdminMenuItem';} ?>" >NFS</a>
                                    <a href="" class="<?php if ($xUri=='05') {echo 'AdminMenuItemNow';} else { echo 'AdminMenuItem';} ?>" >WebDAV</a>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="panelsStayOpen-headingThree">
                                <button style="padding-top:10px;padding-bottom:10px;" class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false" aria-controls="panelsStayOpen-collapseThree">
                                    {{ __('main.menu_service') }}
                                </button>
                            </h2>
                            <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingThree">
                                <div class="accordion-body" style="padding-top:10px;padding-bottom:10px;">
                                    <a href="" class="<?php if ($xUri=='01') {echo 'AdminMenuItemNow';} else { echo 'AdminMenuItem';} ?>" >Rsync</a>
                                    <a href="" class="<?php if ($xUri=='01') {echo 'AdminMenuItemNow';} else { echo 'AdminMenuItem';} ?>" >VM Backup</a>
                                    <a href="" class="<?php if ($xUri=='02') {echo 'AdminMenuItemNow';} else { echo 'AdminMenuItem';} ?>" >Docker</a>
                                    <a href="" class="<?php if ($xUri=='03') {echo 'AdminMenuItemNow';} else { echo 'AdminMenuItem';} ?>" >OpenVPN Server</a>
                                    <a href="" class="<?php if ($xUri=='04') {echo 'AdminMenuItemNow';} else { echo 'AdminMenuItem';} ?>" >OpenVPN Client</a>
                                    <a href="" class="<?php if ($xUri=='05') {echo 'AdminMenuItemNow';} else { echo 'AdminMenuItem';} ?>" >NTP</a>
                                    <a href="" class="<?php if ($xUri=='05') {echo 'AdminMenuItemNow';} else { echo 'AdminMenuItem';} ?>" >UPS</a>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="panelsStayOpen-headingFour">
                                <button style="padding-top:10px;padding-bottom:10px;" class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseFour" aria-expanded="false" aria-controls="panelsStayOpen-collapseFour">
                                    {{ __('main.menu_other') }}
                                </button>
                            </h2>
                            <div id="panelsStayOpen-collapseFour" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingFour">
                                <div class="accordion-body" style="padding-top:10px;padding-bottom:10px;">
                                    <a href="/about" class="<?php if ($xUri=='about') {echo 'AdminMenuItemNow';} else { echo 'AdminMenuItem';} ?>" >{{ __('main.menu_about') }}</a>
                                </div>
                            </div>
                        </div>

                    </div>
                    </td>

