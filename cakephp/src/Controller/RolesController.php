<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Roles Controller
 *
 * @property \App\Model\Table\RolesTable $Roles
 *
 * @method \App\Model\Entity\Role[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RolesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Groups']
        ];
        $roles = $this->paginate($this->Roles);

        $this->set(compact('roles'));
    }

    /**
     * View method
     *
     * @param string|null $id Role id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $role = $this->Roles->get($id, [
            'contain' => ['Groups', 'Users']
        ]);

        $this->set('role', $role);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $role = $this->Roles->newEntity();
        if ($this->request->is('post')) {
            $role = $this->Roles->patchEntity($role, $this->request->getData());
            if ($this->Roles->save($role)) {
                $this->Flash->success(__(' {0} foi salvo com sucesso.', 'Role'));

                    return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__(' {0} não pôde ser salvo. Por favor, tente novamente.', 'Role'));
        }
        $groups = $this->Roles->Groups->find('list', ['limit' => 200]);
        $this->set(compact('role', 'groups'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Role id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $role = $this->Roles->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $role = $this->Roles->patchEntity($role, $this->request->getData());
            if ($this->Roles->save($role)) {
                $this->Flash->success(__(' {0} foi salvo com sucesso.', 'Role'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__(' {0} não pôde ser salvo. Por favor, tente novamente', 'Role'));
        }
        $groups = $this->Roles->Groups->find('list', ['limit' => 200]);
        $this->set(compact('role', 'groups'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Role id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $role = $this->Roles->get($id);
        $role->removed = 'S';
        if ($this->Roles->save($role)) {
            $this->Flash->success(__(' {0} foi removido com sucesso.', 'Role'));
        } else {
            $this->Flash->error(__(' {0} não pôde ser deletado. Por favor, tente novamente.', 'Role'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
