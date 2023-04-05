<div>
    <form wire:submit.prevent="register">
        <label for="name">名前</label>
        <input type="text" wire:model="name"><br>

        <label for="email">メールアドレス</label>
        <input type="email" wire:model="email"><br>

        <label for="password">パスワード</label>
        <input type="password" wire:model="password"><br>
        <button>登録</button>
    </form>
</div>