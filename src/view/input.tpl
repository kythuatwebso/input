{strip}
	{if $fields->isNotEmpty() && $fields->get('name')}
		<div class="border-bottom border-light py-3">
			<div class="row align-items-center {if $fields->get('gutters')} {$fields->get('gutters')}{/if}">

				{if $fields->get('title')}
					<div class="{if $fields->get('horizontal')} col-12 {else} col-md-2 {/if}">

						<label for="{$fields->get('name')|md5}" class="d-flex font-weight-normal justify-content-between">

							<span>
								{if $fields->get('icon') && $fields->get('iconInside') != true}
									<i class="{$fields->get('icon')} me-1 mr-1"></i>
								{/if}
								{$fields->get('title')}
							</span>

							{if $fields->get('horizontal') == true &&
								$fields->get('helpBottom') != true &&
								$fields->get('help')
							}
								<i class="fa fa-info-circle fa-sm text-muted pophover" data-position="bottom left" data-html="{$fields->get('help')}"></i>
							{/if}
						</label>
					</div>
				{/if}

				<div class="{if $fields->get('horizontal')} col-12 {else} col-md {/if}">
					<div class="{if $fields->get('prepend') || $fields->get('append')} input-group {/if} input-group-{$fields->get('size', 'md')} position-relative">

						{if $fields->get('prepend')}
							<div class="input-group-prepend">
								<div class="input-group-text">
									{$fields->get('prepend')}
								</div>
							</div>
						{/if}

						{if
							$fields->get('type') != 'file' &&
							! $fields->get('prepend') &&
							$fields->get('icon') &&
							$fields->get('iconInside') == true
						}
							<span class="position-absolute start-0 top-50 translate-middle-y p-2" style="z-index:9;">
								<i class="{$fields->get('icon')} fa-sm text-muted"></i>
							</span>
						{/if}

						<input
							type="{$fields->get('type', 'text')}"
							class="{$fields->get('class', 'form-control')} {if $fields->get('type') != 'file' && $fields->get('iconInside') == true && ! $fields->get('prepend')} ps-4 ms-1{/if}"
							name="{$fields->get('name')}"
							id="{$fields->get('name')|md5}"
							{if $fields->get('placeholder')} placeholder="{$fields->get('placeholder')}"{/if}
							{if $fields->get('required')} required {/if}
							{if $fields->get('value')} value="{$fields->get('value')}" {/if}
							{if $fields->get('accept') && $fields->get('type') == 'file'} accept="{$fields->get('accept')}" {/if}
						/>

						{if $fields->get('help') && $fields->get('helpBottom') == true}
							<small class="valid-feedback d-block text-body">
								{$fields->get('help')}
							</small>
						{/if}

						{if $fields->get('append')}
							<div class="input-group-append">
								<span class="input-group-text">{$fields->get('append')}</span>
							</div>
						{/if}
					</div>

				</div>
			</div>
		</div>
	{/if}
{/strip}