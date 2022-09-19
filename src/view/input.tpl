{strip}
	{if $attributes|filled && $attributes.name|filled}
		<div class="border-bottom border-light py-3">
			<div class="row align-items-center">
				<div class="
						{if $attributes.horizontal} col-12 {else} col-md-2 {/if}
					"
				>

					<label for="{$attributes.name|md5}" class="d-flex font-weight-normal justify-content-between">
						<span>{$attributes.label|default:$attributes.title|default:$attributes.name|default:'Title'}</span>
						{if $attributes.help|filled}
							<i class="fa fa-info-circle fa-sm text-muted pophover" data-position="bottom left" data-html="{$attributes.help}"></i>
						{/if}
					</label>
				</div>

				<div class="{if $attributes.horizontal} col-12 {else} col-md {/if}">
					<div class="input-group input-group-{$attributes.size|default:'md'}">

						{if $attributes.prepend|filled}
							<div class="input-group-prepend">
								<div class="input-group-text">
									{$attributes.prepend}
								</div>
							</div>
						{/if}

						<input
							type="{$attributes.type|default:'text'}"
							class="{$attributes.class|default:'form-control'}"
							name="{$attributes.name|default:''}"
							id="{$attributes.name|md5}"
							placeholder="{$attributes.placeholder}"
							{if $attributes.required|filled} required {/if}
							{if $attributes.value|filled} value="{$attributes.value}" {/if}
						/>

						{if $attributes.append|filled}
							<div class="input-group-append">
								<span class="input-group-text">{$attributes.append}</span>
							</div>
						{/if}
					</div>

				</div>
			</div>
		</div>
	{/if}
	{/strip}