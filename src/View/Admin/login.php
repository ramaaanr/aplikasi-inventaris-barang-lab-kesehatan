<?php include __DIR__ . '/../templates/header.php'; ?>

<div class="flex flex-row justify-evenly px-6 pt-20 lg:px-8 bg-neutral-50 min-h-screen">
  <img src="/public/login-hero.svg" class="hidden md:block" width="400" height="400" alt="">

  <div class="rounded-lg shadow-lg bg-white py-8 px-12 h-fit">
    <div class="sm:mx-auto sm:w-full sm:max-w-sm">
      <img class="mx-auto w-auto"
        src="data:image/png;base64,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">
      <h2 class="mt-5 text-center text-2xl font-bold leading-9 tracking-tight text-zinc-700">Masuk Invetaris Lab
        Kesehatan
      </h2>

      <!-- Error Message -->
      <?php if (isset($error)): ?>
      <div class="mt-4 text-center text-red-600 font-semibold">
        <?php echo htmlspecialchars($error); ?>
      </div>
      <?php endif; ?>
    </div>

    <div class="mt-5 sm:mx-auto sm:w-full sm:max-w-sm h-fit">
      <form class="space-y-6" action="/auth/login" method="POST">
        <div>
          <label for="username" class="block text-sm font-medium leading-6 text-gray-900">Username</label>
          <div class="mt-2">
            <input id="username" name="username" type="text" autocomplete="username" required
              class="px-4 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-lime-600 sm:text-sm sm:leading-6"
              placeholder="Enter your username">
          </div>
        </div>

        <div>
          <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Password</label>
          <div class="mt-2">
            <input id="password" name="password" type="password" autocomplete="current-password" required
              class="px-4 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-lime-600 sm:text-sm sm:leading-6"
              placeholder="Enter your password">
          </div>
        </div>

        <div>
          <button type="submit"
            class="flex w-full justify-center rounded-md bg-lime-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-lime-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-lime-600">Login</button>
        </div>
      </form>
    </div>
  </div>
</div>

<?php include __DIR__ . '/../templates/footer.php'; ?>