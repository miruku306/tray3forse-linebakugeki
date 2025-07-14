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

// サインアップ処理
if (signupBtn) {
  signupBtn.addEventListener('click', async () => {
    if (!email || !password || !username) return

    const { data, error } = await supabase.auth.signUp({
      email: email.value,
      password: password.value
    })

    if (error) {
      message.textContent = '登録失敗: ' + error.message
    } else {
      const userId = data.user?.id
      if (userId) {
        const { error: insertError } = await supabase
          .from('profiles')
          .insert([{ id: userId, username: username.value, email: email.value }])

        if (insertError) {
          message.textContent = 'プロフィール保存失敗: ' + insertError.message
          return
        }
      }

      message.style.color = 'green'
      message.textContent = '仮登録完了！確認メールをチェックしてください'
    }
  })
}

// ログイン処理（フォーム送信時）
if (form) {
  form.addEventListener('submit', async (e) => {
    e.preventDefault()

    if (!email || !password) return

    const { data, error } = await supabase.auth.signInWithPassword({
      email: email.value,
      password: password.value
    })

    if (error) {
      message.textContent = 'ログイン失敗: ' + error.message
    } else {
      // プロフィールから username を取得して POST（PHP セッション用）
      const userId = data.user?.id
      if (userId) {
        const { data: profile, error: profileError } = await supabase
          .from('profiles')
          .select('username')
          .eq('id', userId)
          .single()

        if (!profileError && profile?.username) {
          const form = new FormData()
          form.append('username', profile.username)

          // PHP に username を POST（ログインセッション用）
          await fetch('', {
            method: 'POST',
            body: form
          })

          // リダイレクト（PHP 側で処理）
          window.location.href = 'Top.php'
        } else {
          message.textContent = 'プロフィール取得失敗'
        }
      }
    }
  })
}
