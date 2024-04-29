<form action="{{ route('locale.switch') }}" method="post" class="inline-block">
    @csrf
    <select name="locale" onchange="this.form.submit()" class="p-2 rounded bg-gray-100  text-gray-600 dark:text-gray-500 dark:bg-slate-900">
        <option value="en"{{ app()->getLocale() === 'en' ? ' selected' : '' }}>{{ __('English') }}</option>
        <option value="nl"{{ app()->getLocale() === 'nl' ? ' selected' : '' }}>{{ __('Dutch') }}</option>
        <option value="de"{{ app()->getLocale() === 'de' ? ' selected' : '' }}>{{ __('German') }}</option>
        <option value="lu"{{ app()->getLocale() === 'lu' ? ' selected' : '' }}>{{ __('Luo') }}</option>
        <option value="sw"{{ app()->getLocale() === 'sw' ? ' selected' : '' }}>{{ __('Swahili') }}</option>
    </select>
</form>
