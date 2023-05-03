<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 * @property string layout
 *
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $users = $this->paginate($this->Users);

        $this->set(compact('users'));
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);

        $this->set('user', $user);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__(' {0} foi salvo com sucesso.', 'User'));

                    return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__(' {0} não pôde ser salvo. Por favor, tente novamente.', 'User'));
        }
        $groups = $this->Users->Groups->find('list', ['limit' => 200]);
        $roles = $this->Users->Roles->find('list', ['limit' => 200]);
        $this->set(compact('user', 'groups', 'roles'));
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__(' {0} foi salvo com sucesso.', 'User'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__(' {0} não pôde ser salvo. Por favor, tente novamente', 'User'));
        }
        $groups = $this->Users->Groups->find('list', ['limit' => 200]);
        // $this->set(compact('user'));
        // var_dump($groups->toArray());die;
        $this->set(compact('user', 'groups'));
    }


    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        $user->removed = 'S';
        if ($this->Users->save($user)) {
            $this->Flash->success(__(' {0} foi removido com sucesso.', 'User'));
        } else {
            $this->Flash->error(__(' {0} não pôde ser deletado. Por favor, tente novamente.', 'User'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * @return \Cake\Http\Response|null
     * @throws \Aura\Intl\Exception
     */
    public function login()
    {
        $this->layout = 'login';
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                return $this->redirect($this->Auth->redirectUrl());
            } else {
                $this->Flash->error(__('Username or password is incorrect'));
            }
        }
    }

    /**
     * @return \Cake\Http\Response|null
     */
    public function logout()
    {
        return $this->redirect($this->Auth->logout());
    }
}


