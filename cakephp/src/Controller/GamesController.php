<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\I18n\Time;
use Cake\Datasource\ConnectionManager;

/**
 * Games Controller
 *
 * @property \App\Model\Table\GamesTable $Games
 *
 * @method \App\Model\Entity\Game[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class GamesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users'],
            'order' => ['id' => 'desc']
        ];
        $games = $this->paginate($this->Games);

        $this->set(compact('games'));
    }

    /**
     * View method
     *
     * @param string|null $id Game id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $game = $this->Games->get($id, [
            'contain' => ['Users']
        ]);
        $this->set('game', $game);
    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $game = $this->Games->newEntity();
        if ($this->request->is('post')) {
            $game = $this->Games->patchEntity($game, $this->request->getData());
            $game->year = $game->data->i18nFormat('yyyy');
            $game->month =  $game->data->i18nFormat('MM');
            $game->week =  date("W", strtotime($game->data->i18nFormat('yyyy-MM-dd')));
            if ($this->Games->save($game)) {
                $this->Flash->success(__(' {0} foi salvo com sucesso.', 'Game'));

                    return $this->redirect(['action' => 'add']);
            }
            $this->Flash->error(__(' {0} não pôde ser salvo. Por favor, tente novamente.', 'Game'));
        }
        $users = $this->Games->Users->find('list')->where(['Users.active' => 'S']);
        $this->set(compact('game', 'users'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function addMany($user1 = null, $user2 = null, $user3 = null, $user4 = null)
    {
        $lastGame = $this->Games->find('all')->where(['game <>' => 0])->order(['id' => 'desc'])->first();
        if ($this->request->is('post')) {
            $maxGame = $lastGame->game + 1;

            $games = $this->Games->newEntities($this->request->getData('game'));
            $gamesToContinue = [];
            $ganhadores = "";
            foreach($games as $game){
                $game->data = Time::now();
                $game->game = $maxGame;
                $game->type_game = 'O';
                $game->qtd_games = 1;
                $game->qtd_win = 0;
                $game->year = $game->data->i18nFormat('yyyy');
                $game->month =  $game->data->i18nFormat('MM');
                $game->week =  date("W", strtotime($game->data->i18nFormat('yyyy-MM-dd')));
                if($game->win == true){
                    $game->qtd_win = 1;
                    $user = $this->Games->Users->find('all')->where(['Users.id' => $game->user_id])->first();
                    $ganhadores .= " " . $user->name;
                }
                if($game->win == true || $this->request->getData('continua_todos') == 'true'){
                    $gamesToContinue[] = $game->user_id;
                }else{
                    $gamesToContinue[] = 0;
                }
            }
            if ($this->Games->saveMany($games)) {
                $this->Flash->success(__(' {0} foi salvo com sucesso. A dupla '.$ganhadores, 'Game'));
                if($this->request->getData('continua') == 'true' || $this->request->getData('continua_todos') == 'true'){
                    return $this->redirect(['action' => 'addMany', $gamesToContinue[0], $gamesToContinue[1], $gamesToContinue[2], $gamesToContinue[3]]);
                }else{
                    return $this->redirect(['action' => 'index']);
                }
            }else{
                $this->Flash->error(__(' {0} não pôde ser salvo. Por favor, tente novamente.', 'Game'));
            }
        }else{
            if($user1 != null)$games[] = $this->Games->newEntity(['user_id' => $user1]);
            if($user2 != null)$games[] = $this->Games->newEntity(['user_id' => $user2]);
            if($user3 != null)$games[] = $this->Games->newEntity(['user_id' => $user3]);
            if($user4 != null)$games[] = $this->Games->newEntity(['user_id' => $user4]);
        }
        //B => Bomba,\nL => Lasquina,\nS => Simples,\nBL => Bomba Lasquina,\nFN => Fechou natural,\nFF => Fechou Querendo / 'FNP' => 'Fechou Natural - Perdeu', 'M' => 'Merda'
        $type_win = ['' => 'Selecione',  'S' => 'Simples', 'L' => 'Lasquina', 'B' => 'Bomba', 'BL' => 'Bomba Lasquina', 'FNG' => 'Fechou Natural - Ganhou',  'FFG' => 'Fechou Querendo - Ganhou', 'FFP' => 'Fechou Querendo - Perdeu', 'M' => 'Merda'];
        $users = $this->Games->Users->find('list')->where(['Users.active' => 'S']);

        $sql = "SELECT
                    G.data,
                    G.user_id,
                    U.name,
                    Sum(G.qtd_games) as qtd_games,
                    Sum(G.qtd_win) as qtd_win,
                    (Sum(G.qtd_win) / Sum(G.qtd_games)) * 100 as Perc_Vit,
                    Sum(G.cheat) as qtd_merdas
                FROM `games` G
                Join `users` U On U.id = G.user_id
                WHERE G.data = DATE(NOW())
                GROUP By 
                    G.data,
                    G.user_id,
                    U.name
                Order By 
                    G.data,
                    Perc_Vit desc,
                    qtd_merdas,
                    qtd_win desc,
                    U.name";

        $connection = ConnectionManager::get('default');
        $results = $connection->execute($sql)->fetchAll('assoc');
        $this->set(compact('games', 'users', 'type_win', 'results'));
    }


    /**
     * Edit method
     *
     * @param string|null $id Game id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $game = $this->Games->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $game = $this->Games->patchEntity($game, $this->request->getData());
            if ($this->Games->save($game)) {
                $this->Flash->success(__(' {0} foi salvo com sucesso.', 'Game'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__(' {0} não pôde ser salvo. Por favor, tente novamente', 'Game'));
        }
        $users = $this->Games->Users->find('list', ['limit' => 200]);
        $this->set(compact('game', 'users'));
    }


    /**
     * Delete method
     *
     * @param string|null $id Game id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $game = $this->Games->get($id);
        if($game->game == 0){
            if ($this->Games->deleteAll(['id' => $game->id])) {
                $this->Flash->success(__(' {0} foi removido com sucesso.', 'Game'));
            } else {
                $this->Flash->error(__(' {0} não pôde ser deletado. Por favor, tente novamente.', 'Game'));
            }
        }else{
            if ($this->Games->deleteAll(['game' => $game->game])) {
                $this->Flash->success(__(' {0} foi removido com sucesso.', 'Game'));
            } else {
                $this->Flash->error(__(' {0} não pôde ser deletado. Por favor, tente novamente.', 'Game'));
            }
        }
       

        return $this->redirect(['action' => 'index']);
    }

    public function testeHora(){
        var_dump(Time::now()->i18nFormat('MM'));
        $date_string = "2019-12-28";
        $date_string2 = "2019-12-29";
        $date_string3 = "2019-12-30";
        $date_string4 = "2020-01-03";
        $date_string5 = "2020-01-04";
        $date_string6 = "2020-01-05";
        $date_string7 = "2020-01-06";
        echo "<br>";
        var_dump(date("W", strtotime($date_string)));
        echo "<br>";
        var_dump(date("W", strtotime($date_string2)));
        echo "<br>";
        var_dump(date("W", strtotime($date_string3)));
        echo "<br>";
        var_dump(date("W", strtotime($date_string4)));
        echo "<br>";
        var_dump(date("W", strtotime($date_string5)));
        echo "<br>";
        var_dump(date("W", strtotime($date_string6)));
        echo "<br>";
        var_dump(date("W", strtotime($date_string7)));
        die;
    }
}