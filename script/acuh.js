import { createClient } from 'https://esm.sh/@supabase/supabase-js'

const supabaseUrl = 'https://bteklaezhlfmjylybrlh.supabase.co'
const supabaseKey = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImJ0ZWtsYWV6aGxmbWp5bHlicmxoIiwicm9sZSI6ImFub24iLCJpYXQiOjE3NTAzMTEzNDYsImV4cCI6MjA2NTg4NzM0Nn0.8YP7M1soC5NpuuhgtmDUB2cL2y6W3yfmL4rgSxaS0TE'
const supabase = createClient(supabaseUrl, supabaseKey)

const form = document.getElementById('authForm')
const email = document.getElementById('email')
const password = document.getElementById('password')
const username = document.getElementById('username')
const message = document.getElementById('message')
const signupBtn = document.getElementById('signupBtn')

// ログイン処理
form.addEventListener('submit', async (e) => {
  e.preventDefault()

  const { error } = await supabase.auth.signInWithPassword({
    username: username.value,
    password: password.value
  })

  if (error) {
    message.textContent = 'ログイン失敗: ' + error.message
  } else {
    message.style.color = 'green'
    message.textContent = 'ログイン成功！'
    setTimeout(() => {
      window.location.href = 'index.php'
    }, 1000)
  }
})

// サインアップ処理
signupBtn.addEventListener('click', async () => {
  const { data, error } = await supabase.auth.signUp({
    email: email.value,
    password: password.value
  })

  if (error) {
    message.textContent = '登録失敗: ' + error.message
  } else {
    // ユーザーIDを取得し、profilesテーブルに追加
    const userId = data.user?.id
    if (userId) {
      const { error: insertError } = await supabase
        .from('profiles')
        .insert([{ id: userId, username: username.value }])

      if (insertError) {
        message.textContent = 'プロフィール保存失敗: ' + insertError.message
        return
      }
    }

    message.style.color = 'green'
    message.textContent = '仮登録完了！確認メールをチェックしてください'
  }
})